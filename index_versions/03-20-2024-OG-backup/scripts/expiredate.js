var app;

(function() {
  'use strict';
  
  app = {
    monthAndSlashRegex: /^\d\d \/ $/, // regex to match "MM / "
    monthRegex: /^\d\d$/, // regex to match "MM"
    el_expDate: '#inputExpDate',
    el_ccUnknown: 'cc_type_unknown',
    
  };
  
  app.addListeners = function() {
      $(app.el_expDate).on('keydown', function(e) {
        app.removeSlash(e);
      });

      $(app.el_expDate).on('keyup', function(e) {
        app.addSlash(e);
      });

      $(app.el_expDate).on('blur', function(e) { //blur
        app.populateDate(e);
      });

      $(app.el_expDate).on('keypress', function(e) {
        return e.charCode >= 48 && e.charCode <= 57;
      });  
  };
  
  app.addSlash = function (e) {
    var isMonthEntered = app.monthRegex.exec(e.target.value);
    if (e.key >= 0 && e.key <= 9 && isMonthEntered) {
      e.target.value = e.target.value + " / ";
    }
  };
  
  app.removeSlash = function(e) {
    var isMonthAndSlashEntered = app.monthAndSlashRegex.exec(e.target.value);
    if (isMonthAndSlashEntered && e.key === 'Backspace') {
      e.target.value = e.target.value.slice(0, -3);
    }
  };
  
  app.populateDate = function(e) {
    var month, year;
    if (e.target.value.length == 7) {
      console.log("==============");
      month = parseInt(e.target.value.slice(0, -5));
      year = "20" + e.target.value.slice(5);
      
    console.log("==============:" + month);
    console.log("==============:" + year);
    
      if (app.checkMonth(month)) {
        var monYr = $(app.el_expDate).val().split(" / ");
        $(app.el_expDate).val(monYr[0] + " / " + monYr[1]);
      } else {
        $(app.el_expDate).val("");
      }
      
      if (app.checkYear(year)) {
        var monYr = $(app.el_expDate).val().split(" / ");
        $(app.el_expDate).val(monYr[0] + " / " + monYr[1]);
      } else {
        $(app.el_expDate).val("");
      }
      
    }else{
      $(app.el_expDate).val("");
    }
  };
  
  app.checkMonth = function(month) {
    if (month <= 12) {
      return true; 
    }
    return false;
  };
  
  app.checkYear = function(year) {
    var currentYear = (new Date()).getFullYear();
    console.log("==============currentYear:" + currentYear + ' selected: ' + year);
    if (year >= currentYear) {
      return true; 
    }
    return false;
  };
          
  app.getSelectOptions = function(select) {
    var options = select.find('option');
    console.log("options:"+options);

    var optionValues = [];
    for (var i = 0; i < options.length; i++) {
      optionValues[i] = options[i].value;
      console.log("options[i].value:"+options[i].value);
    }
    return optionValues;
  };
  
  app.setMaxLength = function ($elem, length) {
    if($elem.length && app.isInteger(length)) {
      $elem.attr('maxlength', length);
    }else if($elem.length){
      $elem.attr('maxlength', '');
    }
  };
  
  app.isInteger = function(x) {
    return (typeof x === 'number') && (x % 1 === 0);
  };

  app.createExpDateField = function() {
    $(app.el_monthSelect +', '+ app.el_yearSelect).hide();
    $(app.el_monthSelect).parent().prepend('<input type="text" class="ccFormatMonitor">');
  };
  
  
  app.init = function() {

    app.addListeners();
    
  }();
  
})();