<?php
$payroll 		= new Payroll;
$payrollName 	= $name;
$payrollList  	= $payroll->get_payroll( $payrollName );
$payroll_dates 	= $payroll->get_payroll_dates( $payrollName );
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $payrollName; ?></title>
	<style type="text/css">
		*{
			margin:0;
			padding: 0;
		}
		html {
		    display: block;
		}
		body{
			padding:10px;
		}
		table {
		    display: table;
		    border-collapse: collapse;
			width: 100%;
			border:none;
		}
		table thead tr {    
			text-align: center;
			border:none;
		}
		table thead tr, table tfoot tr{
			background-color: #eee;
			font-weight: bold;
		}
		table tbody tr td, table tfoot tr td {
		    text-align: right;
		}
		table tbody tr td.fullname, table tfoot tr td.fullname {
		    text-align: left;
		}
		td, th {
		    /*display: table-cell;*/
		    vertical-align: inherit;
		    border: 1px solid #000;
		    padding: 2px;
		    font-size: 8px;
		    width: 24px !important;
		}
		table thead tr td{
			font-size:8px;
		}
		td.fullname{
			width: 40px;
		}
		td.signature{
			width: 60px;
		}
		#print-header {
		    margin-bottom: 36px;
		}
	</style>
</head>
<body>
	<div id="print-header"  style="text-align: center;">
		<h1>Payroll Distribution</h1>
        <p>Date From: <?php echo $payroll_dates[0]->date_from; ?> Date To: <?php echo $payroll_dates[0]->date_to; ?></p>
	</div>
	<div id="payrollListTable-wrapper">
	  <table class="table table-bordered" id="payrollTable" width="100%" cellspacing="0">
	    <thead>
			<tr>
				<td class="fullname" rowspan="2">Emp. Name</td>
				<td rowspan="2">Initial Salary</td>
				<td rowspan="2">Prem.</td>
				<td rowspan="2">OT</td>
				<td rowspan="2">PERA / ACA</td>
                <td rowspan="2">Rice Allow.</td>
				<td rowspan="2">Adj.</td>
				<td rowspan="2">Gross Salary</td>
				<td colspan="11" style="text-align: center;">Deductions</td>                 
				<td rowspan="2">Total Deduc.</td>
				<td rowspan="2">Net Income</td>
				<td class="signature" rowspan="2">Signature</td>
			</tr>
			<tr>
				<td>SSS</td>
				<td>HDMF</td>
				<td>PHIL HEALTH</td>
				<td>GSIS</td>
				<td>SSS LOAN</td>
				<td>HDMF LOAN</td>
				<td>POLICY LOAN</td>
				<td>GSIS LOAN</td>
				<td>ELA/SOS<br/>EL/CA LOAN</td>
				<td>Late</td>    
				<td>W/ Tax</td>              
			</tr>
	    </thead>
	    <tbody>
		  <?php
			// Total variables
			$_initial_salary 	= 0;
			$_leave_amount 		= 0;
			$_thn_month 		= 0;
			$_reg_holiday 		= 0;
			$_sp_holiday 		= 0;
			$_prm_holiday 		= 0;
			$_ot_amount 		= 0;
			$_night_diff 		= 0;
			$_allow_pera 		= 0;
			$_allow_rice 		= 0;
			$_adjustment 		= 0;
			$_gross_salary 		= 0;
			$_sss_cont 	 		= 0;
			$_hdmf_cont 		= 0;
			$_phil_cont 		= 0;
			$_gsis_cont 		= 0;
			$_loan_sss 			= 0;
			$_loan_hdmf 		= 0;
			$_loan_policy 		= 0;
			$_ela_sos 			= 0;
			$_uniform 			= 0;
			$_other_deduction 	= 0;
			$_cash_advance 		= 0;
			$_late_amount 		= 0;
			$_withholding_tax 	= 0;
			$_total_deduction 	= 0;
			$_net_salary 		= 0;
		  ?>
	      <?php foreach( $payrollList as $list ): ?>
	        <?php
			$consume_hour   = format_value( $list->consume_hour, 2 );
			$initial_salary = format_value( $list->initial_salary );
        	$pay_type       = format_value( $list->pay_type );
	        $rate_hour      = format_value( $list->rate_hour, 2 );
	        $daily_rate     = format_value( $list->daily_rate, 2 );
	        $leave_amount   = format_value( $list->leave_amount, 2 );
	        $thn_month      = format_value( $list->thn_month, 2 );
	        $reg_holiday    = format_value( $list->reg_holiday, 2 );
	        $sp_holiday     = format_value( $list->sp_holiday, 2 );
	        $prm_holiday    = format_value( $list->prm_holiday, 2 );
	        $ot_amount      = format_value( $list->ot_amount, 2 );
	        $night_diff     = format_value( $list->night_diff, 2 );
	        $amt_cola       = format_value( $list->amt_cola, 2 );
	        $allow_pera     = format_value( $list->allow_pera, 2 );
	        $allow_rice     = format_value( $list->allow_rice, 2 );
	        $adjustment     = format_value( $list->adjustment, 2 );
	        $sss_cont       = format_value( $list->sss_cont, 2 );
	        $hdmf_cont      = format_value( $list->hdmf_cont, 2 );
	        $phil_cont      = format_value( $list->phil_cont, 2 );
	        $gsis_cont      = format_value( $list->gsis_cont, 2 );
	        $loan_sss       = format_value( $list->loan_sss, 2 );
	        $loan_hdmf      = format_value( $list->loan_hdmf, 2 );
	        $loan_policy      = format_value( $list->loan_policy, 2 );
	        $loan_gsis      = format_value( $list->loan_gsis, 2 );
	        $ela_sos      = format_value( $list->ela_sos, 2 );
	        $uniform        = format_value( $list->uniform, 2 );
	        $other_deduction = format_value( $list->other_deduction, 2 );
	        $cash_advance   = format_value( $list->cash_advance, 2 );
	        $late_amount    = format_value( $list->late_amount, 2 );
			$withholding_tax = format_value( $list->withholding_tax, 2 );
			// initial Salary
			if( $pay_type != 2 ){
				$initial_salary = $consume_hour * $list->rate_hour;
			}
			// Gross Salary
			$gross_salary   = $initial_salary + $leave_amount + $thn_month + $reg_holiday + $sp_holiday + $prm_holiday + $ot_amount + $night_diff + $amt_cola + $adjustment + $allow_pera + $allow_rice;
			// Total Deduction
			$total_deduction  = $sss_cont + $hdmf_cont + $phil_cont + $loan_sss + $loan_hdmf + $uniform + $other_deduction + $cash_advance + $late_amount + $withholding_tax + $loan_policy + $loan_gsis + $ela_sos + $gsis_cont;
			// NET Salary
			$net_salary     = $gross_salary - $total_deduction;
			
			$_initial_salary 	+= $initial_salary;
			$_leave_amount 		+= $leave_amount;
			$_thn_month 		+= $thn_month;
			$_reg_holiday	 	+= $reg_holiday;
			$_sp_holiday 		+= $sp_holiday;
			$_prm_holiday 		+= $prm_holiday;
			$_ot_amount 		+= $ot_amount;
			$_night_diff 		+= $night_diff;
			$_amt_cola 			+= $amt_cola;
			$_allow_pera 		+= $allow_pera;
			$_allow_rice		+= $allow_rice;
			$_adjustment 		+= $adjustment;
			$_gross_salary 		+= $gross_salary;
			$_sss_cont 			+= $sss_cont;
			$_hdmf_cont 		+= $hdmf_cont;
			$_phil_cont 		+= $phil_cont;
			$_gsis_cont 		+= $gsis_cont;
			$_loan_sss 			+= $loan_sss;
			$_loan_hdmf 		+= $loan_hdmf;
			$_loan_policy 		+= $loan_policy;
			$_ela_sos 			+= $ela_sos;
			$_uniform 			+= $uniform;
			$_other_deduction 	+= $other_deduction;
			$_cash_advance 		+= $cash_advance;
			$_late_amount 		+= $late_amount;
			$_withholding_tax 	+= $withholding_tax;
			$_total_deduction 	+= $total_deduction;
			$_net_salary 		+= $net_salary;
	        ?>
	        <tr>
	          <td class="fullname"><?php echo $list->employee; ?></td>
	          <td><?php echo format_value( $initial_salary, 2 ); ?></td>
	          <td><?php echo $prm_holiday; ?></td>
	          <td><?php echo $ot_amount; ?></td>
			  <td><?php echo $allow_pera; ?></td>
	          <td><?php echo $allow_rice; ?></td>
	          <td><?php echo $adjustment; ?></td>
	          <td><?php echo format_value( $gross_salary, 2  ); ?></td>
	          <td><?php echo $sss_cont; ?></td>
	          <td><?php echo $hdmf_cont; ?></td>
	          <td><?php echo $phil_cont; ?></td>
	          <td><?php echo $gsis_cont; ?></td>
	          <td><?php echo $loan_sss; ?></td>
	          <td><?php echo $loan_hdmf; ?></td>
	          <td><?php echo $loan_policy; ?></td>
	          <td><?php echo $loan_gsis; ?></td>
	          <td><?php echo $ela_sos; ?></td>
	          <td><?php echo $late_amount; ?></td>                     
	          <td><?php echo $withholding_tax; ?></td>
	          <td><?php echo format_value( $total_deduction, 2  ); ?></td>
	          <td><?php echo format_value( $net_salary, 2  ); ?></td>
	          <td class="signature"></td>
	        </tr>
	      <?php  endforeach; ?>
	    </tbody>
		<tfoot>
			<tr>
			  <td class="fullname">Total</td>
	          <td><?php echo format_value( $_initial_salary, 2 ); ?></td>
	          <td><?php echo format_value( $_prm_holiday, 2 ); ?></td>
	          <td><?php echo format_value( $_ot_amount, 2 ); ?></td>
			  <td><?php echo format_value( $_allow_pera, 2 ); ?></td>
	          <td><?php echo format_value( $_allow_rice, 2 ); ?></td>
	          <td><?php echo format_value( $_adjustment, 2 ); ?></td>
	          <td><?php echo format_value( $_gross_salary, 2  ); ?></td>
	          <td><?php echo format_value( $_sss_cont, 2 ); ?></td>
	          <td><?php echo format_value( $_hdmf_cont, 2 ); ?></td>
	          <td><?php echo format_value( $_phil_cont, 2 ); ?></td>
	          <td><?php echo format_value( $_gsis_cont, 2 ); ?></td>
	          <td><?php echo format_value( $_loan_sss, 2 ); ?></td>
	          <td><?php echo format_value( $_loan_hdmf, 2 ); ?></td>
	          <td><?php echo format_value( $_loan_policy, 2 ); ?></td>
	          <td><?php echo format_value( $_loan_gsis, 2 ); ?></td>
	          <td><?php echo format_value( $_ela_sos, 2 ); ?></td>
	          <td><?php echo format_value( $_late_amount, 2 ); ?></td>                     
	          <td><?php echo format_value( $_withholding_tax, 2 ); ?></td>
	          <td><?php echo format_value( $_total_deduction, 2  ); ?></td>
	          <td><?php echo format_value( $_net_salary, 2  ); ?></td>
	          <td class="signature"></td>
			</tr>
		</tfoot>
	  </table> 
	</div>
</body>
</html>