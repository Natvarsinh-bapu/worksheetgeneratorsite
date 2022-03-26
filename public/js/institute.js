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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/institute.js":
/*!***********************************!*\
  !*** ./resources/js/institute.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// code for remove alert message after 5 seconds
$(document).ready(function () {
  var alert_exist = $(document).find('.alert').length;

  if (alert_exist > 0) {
    $('.alert').delay(4000).fadeOut();
  }
});

__webpack_require__(/*! ../js/institute/categories */ "./resources/js/institute/categories.js");

__webpack_require__(/*! ../js/institute/concepts */ "./resources/js/institute/concepts.js");

__webpack_require__(/*! ../js/institute/types */ "./resources/js/institute/types.js");

__webpack_require__(/*! ../js/institute/sub_concept */ "./resources/js/institute/sub_concept.js");

__webpack_require__(/*! ../js/institute/questions */ "./resources/js/institute/questions.js");

__webpack_require__(/*! ../js/institute/profile */ "./resources/js/institute/profile.js");

__webpack_require__(/*! ../js/institute/class */ "./resources/js/institute/class.js");

__webpack_require__(/*! ../js/institute/teachers */ "./resources/js/institute/teachers.js");

__webpack_require__(/*! ../js/institute/students */ "./resources/js/institute/students.js");

/***/ }),

/***/ "./resources/js/institute/categories.js":
/*!**********************************************!*\
  !*** ./resources/js/institute/categories.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for categories datatable

  $(function () {
    var datatable = $('#institute_categories_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/categories-datatable',
      "columns": [{
        data: 'category',
        name: 'category'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove category

  $(document).on('click', '._remove_category', function () {
    $('#category_delete_modal').show();
    $(document).find('#category_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#category_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/class.js":
/*!*****************************************!*\
  !*** ./resources/js/institute/class.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for class datatable

  $(function () {
    var datatable = $('#institute_class_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/class-datatable',
      "columns": [{
        data: 'name',
        name: 'name'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove class

  $(document).on('click', '._remove_class', function () {
    $('#class_delete_modal').show();
    $(document).find('#class_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#class_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/concepts.js":
/*!********************************************!*\
  !*** ./resources/js/institute/concepts.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for concepts datatable

  $(function () {
    var datatable = $('#institute_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/concepts-datatable',
      "columns": [{
        data: 'concept',
        name: 'concept'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove concept

  $(document).on('click', '._remove_concept', function () {
    $('#concept_delete_modal').show();
    $(document).find('#concept_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#concept_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/profile.js":
/*!*******************************************!*\
  !*** ./resources/js/institute/profile.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(document).on('change', '#profile_pic_upload', function (e) {
    var extension_array = ['png', 'jpg', 'jpeg', 'gif'];
    var filename = e.target.files[0].name;
    var extension = filename.substr(filename.lastIndexOf('.') + 1);

    if ($.inArray(extension, extension_array) != -1) {
      $(document).find('#profile_pic_form').submit();
    } else {
      $(document).find('#file_upload_error').html('Please select file with valid extension');
    }
  }); //update admin details

  $(document).on('click', '#edit_profile', function () {
    $(this).hide();
    $(document).find('._back_btn').hide();
    $(document).find('#update_profile').show();
    $(document).find('#cancel_profile').show();
    $('._profile_field').each(function () {
      $(this).show();
    });
    $('._profile_label').each(function () {
      $(this).hide();
    });
  });
  $(document).on('click', '#cancel_profile', function () {
    $(this).hide();
    $(document).find('._back_btn').show();
    $(document).find('#update_profile').hide();
    $(document).find('#edit_profile').show();
    $('._profile_field').each(function () {
      $(this).hide();
    });
    $('._profile_label').each(function () {
      $(this).show();
    });
  }); //submit form

  $(document).on('submit', '#profile_form', function () {
    var name = $(document).find('#profile_name').val();
    var phone = $(document).find('#profile_phone').val();
    $(document).find('._error_message_name').remove();
    $(document).find('._error_message_phone').remove();

    if (name == '') {
      $(document).find('#profile_name').after('<br><span class="_error_message_name" style="color:red;">Please enter name</span>');
      return false;
    }

    if (phone == '') {
      $(document).find('#profile_phone').after('<br><span class="_error_message_phone" style="color:red;">Please enter phone</span>');
      return false;
    }

    return true;
  });
});

/***/ }),

/***/ "./resources/js/institute/questions.js":
/*!*********************************************!*\
  !*** ./resources/js/institute/questions.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for question datatable

  $(function () {
    var datatable = $('#institute_questions_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/questions-datatable',
      "columns": [{
        data: 'question',
        name: 'question'
      }, {
        data: 'medium_id',
        name: 'medium_id'
      }, {
        data: 'question_file',
        name: 'question_file'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove question

  $(document).on('click', '._remove_question', function () {
    $('#question_delete_modal').show();
    $(document).find('#question_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#question_delete_modal').hide();
  }); //code for dynamic option in sub-concepts

  function get_sub_concepts(concept_id, is_for, question_id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/institute/get-sub-concepts',
      type: 'POST',
      data: {
        concept_id: concept_id,
        is_for: is_for,
        question_id: question_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          var sub_concepts = data.sub_concepts;
          var options = '';

          if (is_for == 'edit') {
            $.each(sub_concepts, function (index, val) {
              if (data.selected_sub_concept == val.id) {
                options += '<option value="' + val.id + '" selected>' + val.sub_concept + '</option>';
              } else {
                options += '<option value="' + val.id + '">' + val.sub_concept + '</option>';
              }
            });
            $(document).find('#institute_sub_concept_edit').html(options);
          } else {
            $.each(sub_concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.sub_concept + '</option>';
            });
            $(document).find('#institute_sub_concept').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  var institute_concept = $(document).find('#institute_concept');

  if (institute_concept.length > 0) {
    get_sub_concepts(institute_concept.val(), 'add', 0); //call function
  }

  $(document).on('change', '#institute_concept', function () {
    get_sub_concepts($(this).val(), 'add', 0); //call function
  });
  var institute_concept_edit = $(document).find('#institute_concept_edit');

  if (institute_concept_edit.length > 0) {
    var question_id = $(document).find('#edit_question_span').attr('data-id');
    get_sub_concepts(institute_concept_edit.val(), 'edit', question_id); //call function
  }

  $(document).on('change', '#institute_concept_edit', function () {
    var question_id = $(document).find('#edit_question_span').attr('data-id');
    get_sub_concepts(institute_concept_edit.val(), 'edit', question_id); //call function
  });
});

/***/ }),

/***/ "./resources/js/institute/students.js":
/*!********************************************!*\
  !*** ./resources/js/institute/students.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for student datatable

  $(function () {
    var datatable = $('#institute_students_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/students-datatable',
      "columns": [{
        data: 'name',
        name: 'name'
      }, {
        data: 'email',
        name: 'email'
      }, {
        data: 'enrollment_no',
        name: 'enrollment_no'
      }, {
        data: 'class',
        name: 'class'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove student

  $(document).on('click', '._remove_student', function () {
    $('#student_delete_modal').show();
    $(document).find('#student_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#student_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/sub_concept.js":
/*!***********************************************!*\
  !*** ./resources/js/institute/sub_concept.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for sub-concepts datatable

  $(function () {
    var datatable = $('#institute_sub_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/sub-concepts-datatable',
      "columns": [{
        data: 'sub_concept',
        name: 'sub_concept'
      }, {
        data: 'concept_id',
        name: 'concept_id'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove sub-concept

  $(document).on('click', '._remove_sub_concept', function () {
    $('#sub_concept_delete_modal').show();
    $(document).find('#sub_concept_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#sub_concept_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/teachers.js":
/*!********************************************!*\
  !*** ./resources/js/institute/teachers.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for teacher datatable

  $(function () {
    var datatable = $('#institute_teachers_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/teachers-datatable',
      "columns": [{
        data: 'name',
        name: 'name'
      }, {
        data: 'email',
        name: 'email'
      }, {
        data: 'phone',
        name: 'phone'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove teacher

  $(document).on('click', '._remove_teacher', function () {
    $('#teacher_delete_modal').show();
    $(document).find('#teacher_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#teacher_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/institute/types.js":
/*!*****************************************!*\
  !*** ./resources/js/institute/types.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for types datatable

  $(function () {
    var datatable = $('#institute_types_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/institute/types-datatable',
      "columns": [{
        data: 'type',
        name: 'type'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove type

  $(document).on('click', '._remove_type', function () {
    $('#type_delete_modal').show();
    $(document).find('#type_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#type_delete_modal').hide();
  });
});

/***/ }),

/***/ 3:
/*!*****************************************!*\
  !*** multi ./resources/js/institute.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\worksheetgenerator\resources\js\institute.js */"./resources/js/institute.js");


/***/ })

/******/ });