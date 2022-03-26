/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/teacher.js":
/*!*********************************!*\
  !*** ./resources/js/teacher.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./user/teacher/worksheet_assign */ "./resources/js/user/teacher/worksheet_assign.js");

/***/ }),

/***/ "./resources/js/user/teacher/worksheet_assign.js":
/*!*******************************************************!*\
  !*** ./resources/js/user/teacher/worksheet_assign.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var assigned_arr = [];
  var baseUrl = window.location.origin; //select worksheet

  $(document).on('change', '._assign_worksheet', function () {
    var is_checked = $(this).prop('checked');

    if (is_checked) {
      if (assigned_arr.length > 2) {
        $(this).prop('checked', false);
        $('#assign_message').html('You can assign only 3 worksheets at a time');
        $('#assign_limit_modal').modal('show');
        return;
      }

      assigned_arr.push($(this).val());
    } else {
      var index = assigned_arr.indexOf($(this).val());
      assigned_arr.splice(parseInt(index), 1);
    }
  }); //assign

  $(document).on('click', '#assign_btn', function () {
    if (assigned_arr.length < 1) {
      $('#assign_message').html('Please select worksheet to assign');
      $('#assign_limit_modal').modal('show');
      return;
    }

    $(document).find('#class_select').val("");
    $(document).find('#student_list_div').html("<h4>Select class for student list</h4>");
    $('#student_list_modal').modal('show');
  }); //select class

  $(document).on('change', '#class_select', function () {
    var class_id = $(this).val();

    if (class_id == "") {
      $(document).find('#student_list_div').html("<h4>Select class for student list</h4>");
      return;
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/get-students/' + class_id,
      type: 'GET',
      cache: false,
      success: function success(response) {
        var student_list_div = $(document).find('#student_list_div');
        student_list_div.empty();

        if (response.success) {
          student_list_div.append(response.html);
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }); //select all

  $(document).on('change', '#select_all', function () {
    var is_checked = $(this).prop('checked');

    if (is_checked) {
      $(document).find('.assign_student').prop('checked', true);
    } else {
      $(document).find('.assign_student').prop('checked', false);
    }
  }); //assign worksheet done

  $(document).on('click', '#assign_worksheet_done', function () {
    var selected_students = $('._checked_students:checkbox:checked').map(function () {
      return this.value;
    }).get();

    if (selected_students.length < 1) {
      $(document).find('#select_student_err').show();
      return;
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/assign-to-students',
      type: 'POST',
      data: {
        worskheets: assigned_arr,
        selected_students: selected_students
      },
      cache: false,
      success: function success(response) {
        if (response.success) {
          $(document).find('#assigned_alert_div').append('<div class="alert alert-success">' + response.message + '</div>');
        } else {
          $(document).find('#assigned_alert_div').append('<div class="alert alert-danger">' + response.error + '</div>');
        }

        selected_students = [];
        $(document).find('#class_select').val("");
        $(document).find('#student_list_div').html("<h4>Select class for student list</h4>");
        window.setTimeout(function () {
          $(document).find('#assigned_alert_div').empty();
        }, 3000);
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  });
});

/***/ }),

/***/ 5:
/*!***************************************!*\
  !*** multi ./resources/js/teacher.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\worksheetgenerator\resources\js\teacher.js */"./resources/js/teacher.js");


/***/ })

/******/ });