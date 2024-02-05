jQuery(document).ready(function ($) {
  $("#timecardTable .update").on("click", function (e) {
    e.preventDefault();
    let checkinID = $(this).attr("data-id");
    let checkinSched = $(this).attr("data-sched");
    let comment = $(this).attr("data-comment");
    let logDate = $(this).attr("data-date");
    let logTime = $(this).attr("data-time");
    $("#updateLogModal #logID").val(checkinID);
    $("#updateLogModal #checkinSched").val(checkinSched);
    $("#updateLogModal #newDateLog").val(logDate);
    $("#updateLogModal #comment").val(comment);
    $("#updateLogModal #newTimeLog").val(logTime);
  });
  //  Add schedule log
  $("#timecardTable .add-sched-log").on("click", function (e) {
    e.preventDefault();
    let logDate = $(this).attr("data-date");
    let schedule = $(this).attr("data-sched");
    let userID = $(this).attr("data-id");

    $("#addDateLogModal #biometricID").val(userID);
    $("#addDateLogModal #schedDateLog").val(logDate);
    $("#addDateLogModal #schedulelog").val(schedule);
  });
  $(".datepicker").datepicker({
    dateFormat: "yy-mm-dd",
  });
  $("#updateLogModal .timepicker").timepicker();
  $("#updatelog-form").on("submit", function (e) {
    e.preventDefault();
    let logDate = $("#updatelog-form #newDateLog").val();
    let logTime = $("#updatelog-form #newTimeLog").val();
    let checkinSched = $("#updatelog-form #checkinSched").val();
    let comment = $("#updatelog-form #comment").val();
    let logID = $("#updatelog-form #logID").val();
    $.ajax({
      url: "./includes/common/ajax-handler.php",
      type: "POST",
      data: {
        action: "update_log",
        logDate: logDate,
        logTime: logTime,
        logID: logID,
        checkinSched: checkinSched,
        comment: comment,
      },
      beforeSend: function () {
        $("body").append(
          '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
        );
      },
      success: function (data) {
        if( data != 0 ){
        	$('body').prepend('<div class="notification-message alert alert-success">Employee Time Log has been updated, Please reload the page and resubmit form to be able to get the updated Log computation.</div>');
        	$('#timecardTable tbody tr #'+logID).text(data);
        }else{
        	$('body').prepend('<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>');
        }
        $("#updateLogModal").modal("toggle");
        setTimeout(function () {
          $("body .notification-message").remove();
          location.reload();
        }, 3000);
        $("body .lds-ellipsis").remove();
      },
      error: function (log) {
        console.log(log.message);
      },
    });
  });
  $("#openAddlogModal").on("click", function (e) {
    e.preventDefault();
    let biometricID = $(this).attr("data-id");
    $("#addlog-form #biometricID").val(biometricID);
  });
  $('#__absent').on('change', function(){
    let $this = $(this);
    let logSections = $('#log-sections');
    let reasonSection = $('#reason-section');
    let absentReason = $('#__absent_reason');
    absentReason.attr('required', $this.is(':checked'));
    if($this.is(':checked')){
      logSections.addClass('d-none');
      reasonSection.removeClass('d-none');
    } else {
      logSections.removeClass('d-none');
      reasonSection.addClass('d-none');
    }
  });
  $("#addlog-form").on("submit", function (e) {
    e.preventDefault();
    let dateLog = $("#addlog-form #date").val();
    let ftimein = $("#addlog-form #ftimein").val();
    let ftimeout = $("#addlog-form #ftimeout").val();
    let stimein = $("#addlog-form #stimein").val();
    let stimeout = $("#addlog-form #stimeout").val();
    let otin = $("#addlog-form #OTin").val();
    let otout = $("#addlog-form #OTout").val();
    let biometricID = $("#addlog-form #biometricID").val();
    let __absent = $('#__absent');
    let isAbsent = __absent.is(':checked') ? '1' : '0';
    let absentReason = $('#__absent_reason').val();
    if (!dateLog) {
      $("#addlog-form #date").focus();
      alert("Date field required.");
      return false;
    }
    $.ajax({
      url: "./includes/common/ajax-handler.php",
      type: "POST",
      data: {
        action: "add-timelog",
        biometricID: biometricID,
        dateLog: dateLog,
        ftimein: ftimein,
        ftimeout: ftimeout,
        stimein: stimein,
        stimeout: stimeout,
        otin: otin,
        otout: otout,
        isAbsent: isAbsent,
        absentReason: absentReason,
      },
      beforeSend: function () {
        //** before Send
        $("body").append(
          '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
        );
      },
      success: function (data) {
        $("body .lds-ellipsis").remove();
        console.log(data);
        if (data != 0) {
          $("body").prepend(
            '<div class="notification-message alert alert-success">Employee Time Log has been updated, <br/>Please reload the page and resubmit form to be able to get the updated Log computation.</div>'
          );
        } else {
          $("body").prepend(
            '<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>'
          );
        }
        $("#addLogModal").modal("toggle");
        setTimeout(function () {
          $("body .notification-message").remove();
          location.reload();
        }, 3000);
      },
      error: function (log) {
        console.log(log.message);
      },
    });
  });
  $("#scheduleLog-form").on("submit", function (e) {
    e.preventDefault();
    let datelog = $("#scheduleLog-form #schedDateLog").val();
    let timelog = $("#scheduleLog-form #schedTimeLog").val();
    let schedulelog = $("#scheduleLog-form #schedulelog").val();
    let comment = $("#scheduleLog-form #schedComment").val();
    let biometricID = $("#scheduleLog-form #biometricID").val();
    $.ajax({
      url: "./includes/common/ajax-handler.php",
      type: "POST",
      data: {
        action: "add-schedule-timelog",
        biometricID: biometricID,
        datelog: datelog,
        timelog: timelog,
        schedulelog: schedulelog,
        comment: comment,
      },
      beforeSend: function () {
        //** before Send
        $("body").append(
          '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
        );
      },
      success: function (data) {
        $("body .lds-ellipsis").remove();
        console.log(data);
        if (data != 0) {
          $("body").prepend(
            '<div class="notification-message alert alert-success">Employee Time Log has been updated, <br/>Please reload the page and resubmit form to be able to get the updated Log computation.</div>'
          );
        } else {
          $("body").prepend(
            '<div class="notification-message alert alert-danger">Something went wrong, Please reload the page and try again.</div>'
          );
        }
        $("#addDateLogModal").modal("toggle");
        setTimeout(function () {
          $("body .notification-message").remove();
          location.reload();
        }, 1000);
      },
      error: function (log) {
        console.log(log.message);
      },
    });
  });
  // Delete Logs
  $("#timecardTable").on("click", ".delete-log", function (e) {
    e.preventDefault();
    let currElem = $(this);
    let logID = currElem.closest("td").attr("id");
    let logDate = currElem.closest("td").find("span.text-info").text();
    let logUser = currElem.closest("tr").find("td.fullname").text();
    console.log(logDate);
    console.log(logUser);
    let confirmation = confirm("Are you sure you want to delete this Log?");
    if (!confirmation) {
      return;
    }
    $.ajax({
      url: "./includes/common/ajax-handler.php",
      type: "POST",
      datatype: "json",
      data: {
        action: "delete-timelog",
        logID: logID,
        logDate: logDate,
        logUser: logUser,
      },
      beforeSend: function () {
        //** before Send
        $("body .notification-message").remove();
        $("body").append(
          '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
        );
      },
      success: function (data) {
        let {status, message} = JSON.parse(data);
        if (status == "error") {
          $("body .lds-ellipsis").remove();
          $("body").prepend(
            '<div class="notification-message alert alert-danger">' +
              message +
              ".</div>"
          );
        } else {
          $("body").prepend(
            '<div class="notification-message alert alert-success" style="z-index: 9999999999;">' +
              message +
              "</div>"
          );
          currElem.closest("td").html("");
        }
        setTimeout(function () {
          $("body .notification-message").remove();
          if (status == "success") {
            location.reload();
          }
        }, 3000);
      },
      error: function (log) {
        console.log(log.message);
      },
    });
  });
});
