<?php
$payroll 		= new Payroll;
$payrollName 	= $name;
$payrollList  	= $payroll->get_payroll( $payrollName );
$payroll_dates 	= $payroll->get_payroll_dates( $payrollName );
$counter 		= 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $payrollName; ?></title>
	<style type="text/css">
		*{
			margin:0;
			padding: 0;
			font-size: 10px;
			line-height: 1;
		}
		body{
			padding:8px 6px;
			width: 100%;
		}
		.payslip{
			width: 48%;
			float: left;
			padding: 6px;
			border: 1px dashed #333;
			margin-right: 6px;
			margin-bottom: 14px;
		}
		.payslip .header h2{
			font-size: 14px;
		}
		.payslip .header{
			margin-bottom: 10px;
		}
		.align-right{
			text-align: right;
		}
	</style>
</head>
<body>
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

    $gross_salary   = $initial_salary + $leave_amount + $thn_month + $reg_holiday + $sp_holiday + $prm_holiday + $ot_amount + $night_diff + $amt_cola + $adjustment + $allow_pera + $allow_rice;

    $total_deduction  = $sss_cont + $hdmf_cont + $phil_cont + $loan_sss + $loan_hdmf + $uniform + $other_deduction + $cash_advance + $late_amount + $withholding_tax + $loan_policy + $loan_gsis + $ela_sos + $gsis_cont;

    $net_salary     = $gross_salary - $total_deduction;

    ?>
    <div class="payslip">
    	<div class="header" style="text-align: center;">
    		<h2>Company Name</h2>
    	</div>
    	<div class="details">
	    	<table width="100%">
				<thead>
					<tr>
						<td>Name: <span style="font-weight: bold;"><?php echo $list->employee; ?></span></td>
						<td class="align-right">Date: <?php echo $payroll_dates[0]->date_from; ?> to <?php echo $payroll_dates[0]->date_to; ?></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td>Daily Rate:</td>
						<td class="align-right"><span style="font-family: DejaVu Sans;">&#8369;</span> <?php echo $daily_rate; ?></td>
					</tr>
					<tr>
						<td>Initial Salary:</td>
						<td class="align-right"><span style="font-family: DejaVu Sans;">&#8369;</span> <?php echo format_value( $initial_salary, 2 ); ?></td>
					</tr>
					<tr>
						<td>Premium</td>
						<td class="align-right"><?php echo $prm_holiday; ?></td>
					</tr>
					<tr>
						<td>Overtime:</td>
						<td class="align-right"><?php echo $ot_amount; ?></td>
					</tr>
					<tr>
						<td>PERA / ACA</td>
						<td class="align-right"><?php echo $allow_pera; ?></td>
					</tr>
					<tr>
						<td>Rice Allow.</td>
						<td class="align-right"><?php echo $allow_rice; ?></td>
					</tr>
					<tr>
						<td>Adjustment</td>
						<td class="align-right"><?php echo $adjustment; ?></td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td>Gross Salary:</td>
						<td class="align-right"><span style="font-family: DejaVu Sans;">&#8369;</span>  <?php echo format_value( $gross_salary ); ?></td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">Less Deductions</td>
					</tr>
					<tr class="secondary-data">
						<td>SSS cont.:</td>
						<td class="align-right"><?php echo $sss_cont; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>PhilHealth cont.:</td>
						<td class="align-right"><?php echo $phil_cont; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>Pag-ibig/HDMF cont.:</td>
						<td class="align-right"><?php echo $hdmf_cont; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>GSIS cont.:</td>
						<td class="align-right"><?php echo $gsis_cont; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>SSS Sal. Loan:</td>
						<td class="align-right"><?php echo $loan_sss; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>Pag-ibig/HDMF loan:</td>
						<td class="align-right"><?php echo $loan_hdmf; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>Policy Loan:</td>
						<td class="align-right"><?php echo $loan_policy; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>GSIS Loan:</td>
						<td class="align-right"><?php echo $loan_gsis; ?></td>
					</tr>
					<tr class="secondary-data">
						<td>ELA/SOS/EL/CA Loan:</td>
						<td class="align-right"><?php echo $ela_sos; ?></td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">Others</td>
					</tr>
					<tr class="secondary-data">
						<td>Late</td>
						<td class="align-right"><?php echo $late_amount; ?></td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">TAX</td>
					</tr>
					<tr class="secondary-data">
						<td>Withholding TAX</td>
						<td class="align-right"><?php echo $withholding_tax; ?></td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td>NET SALARY:</td>
						<td class="align-right"><span style="font-family: DejaVu Sans;">&#8369;</span>  <?php echo format_value( $net_salary ); ?></td>
					</tr>
					<tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr>
					<tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr><tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr>
					<tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr><tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>4
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr>
					<tr>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 36px 0 0;display:block;width:100%">&nbsp;</span></td>
						<td class="empty"><span style="border-bottom:1px dashed #333;margin:0 0 0 36px;display:block;width:100%">&nbsp;</span></td>
					</tr><tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" class="empty">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2 class="emp-name" style="text-align:center;">
							<span style="font-weight: bold;"><?php echo strtoupper( $list->employee ); ?></span><br/>
							Employee’s Signature
						</td>
					</tr>
				</tbody>
			</table>
		</div>
    </div>
    <?php
    if( $counter % 2  == 0 ){
    	?><div style="display: block;">&nbsp;</div><?php
	}
	if( $counter % 4 == 0 ){
    	?><div style="page-break-after: always;"></div><?php
    }
    $counter++;
    ?>
  <?php  endforeach; ?>
</body>
</html>