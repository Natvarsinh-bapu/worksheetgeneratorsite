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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin.js":
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// code for remove alert message after 5 seconds
$(document).ready(function () {
  var alert_exist = $(document).find('.alert').length;

  if (alert_exist > 0) {
    $('.alert').delay(4000).fadeOut();
  }
});

__webpack_require__(/*! ../js/admin/categories */ "./resources/js/admin/categories.js");

__webpack_require__(/*! ../js/admin/concepts */ "./resources/js/admin/concepts.js");

__webpack_require__(/*! ../js/admin/types */ "./resources/js/admin/types.js");

__webpack_require__(/*! ../js/admin/sub_concept */ "./resources/js/admin/sub_concept.js");

__webpack_require__(/*! ../js/admin/questions */ "./resources/js/admin/questions.js");

__webpack_require__(/*! ../js/admin/profile */ "./resources/js/admin/profile.js");

__webpack_require__(/*! ../js/admin/dashboard */ "./resources/js/admin/dashboard.js");

__webpack_require__(/*! ../js/admin/institutes */ "./resources/js/admin/institutes.js");

/***/ }),

/***/ "./resources/js/admin/categories.js":
/*!******************************************!*\
  !*** ./resources/js/admin/categories.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for categories datatable

  $(function () {
    var datatable = $('#admin_categories_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/categories-datatable',
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

/***/ "./resources/js/admin/concepts.js":
/*!****************************************!*\
  !*** ./resources/js/admin/concepts.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for concepts datatable

  $(function () {
    var datatable = $('#admin_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/concepts-datatable',
      "columns": [{
        data: 'concept',
        name: 'concept'
      }, {
        data: 'category_id',
        name: 'category_id'
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

/***/ "./resources/js/admin/dashboard.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/dashboard.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  //copy to clipboard
  $(document).on('click', '#copy_link', function () {
    var copyText = $(document).find("#shared_link_div").html();
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($.trim(copyText)).select();
    document.execCommand("copy");
    $temp.remove();
    $(document).find('#alert_div').append('<div class="alert alert-success" role="alert">' + 'Link copied!' + '</div>');
    $('.alert').delay(4000).fadeOut();
  });
});

/***/ }),

/***/ "./resources/js/admin/institutes.js":
/*!******************************************!*\
  !*** ./resources/js/admin/institutes.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for categories datatable

  $(function () {
    var datatable = $('#admin_institutes_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/institutes-datatable',
      "columns": [{
        data: 'name',
        name: 'name'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove category

  $(document).on('click', '._remove_institute', function () {
    $('#institute_delete_modal').show();
    $(document).find('#institute_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#institute_delete_modal').hide();
  });
});

/***/ }),

/***/ "./resources/js/admin/profile.js":
/*!***************************************!*\
  !*** ./resources/js/admin/profile.js ***!
  \***************************************/
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

/***/ "./resources/js/admin/questions.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/questions.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for questions datatable

  $(function () {
    var datatable = $('#admin_questions_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/questions-datatable',
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
      url: baseUrl + '/admin/get-sub-concepts',
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
            $(document).find('#admin_sub_concept_edit').html(options);
          } else {
            $.each(sub_concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.sub_concept + '</option>';
            });
            $(document).find('#admin_sub_concept').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  var admin_concept = $(document).find('#admin_concept');

  if (admin_concept.length > 0) {
    get_sub_concepts(admin_concept.val(), 'add', 0); //call function
  }

  $(document).on('change', '#admin_concept', function () {
    get_sub_concepts($(this).val(), 'add', 0); //call function
  });
  var admin_concept_edit = $(document).find('#admin_concept_edit');

  if (admin_concept_edit.length > 0) {
    var question_id = $(document).find('#edit_question_span').attr('data-id');
    get_sub_concepts(admin_concept_edit.val(), 'edit', question_id); //call function
  }

  $(document).on('change', '#admin_concept_edit', function () {
    var question_id = $(document).find('#edit_question_span').attr('data-id');
    get_sub_concepts(admin_concept_edit.val(), 'edit', question_id); //call function
  });
});

/***/ }),

/***/ "./resources/js/admin/sub_concept.js":
/*!*******************************************!*\
  !*** ./resources/js/admin/sub_concept.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for sub-concepts datatable

  $(function () {
    var datatable = $('#admin_sub_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/sub-concepts-datatable',
      "columns": [{
        data: 'sub_concept',
        name: 'sub_concept'
      }, {
        data: 'concept_id',
        name: 'concept_id'
      }, {
        data: 'category_id',
        name: 'category_id'
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
  }); //code for dynamic option in concept

  function get_concepts(category_id, is_for, sub_concept_id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/admin/get-concepts',
      type: 'POST',
      data: {
        category_id: category_id,
        is_for: is_for,
        sub_concept_id: sub_concept_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          var concepts = data.concepts;
          var options = '';

          if (is_for == 'edit') {
            $.each(concepts, function (index, val) {
              if (data.selected_concept == val.id) {
                options += '<option value="' + val.id + '" selected>' + val.concept + '</option>';
              } else {
                options += '<option value="' + val.id + '">' + val.concept + '</option>';
              }
            });
            $(document).find('#admin_concept_for_sub_concept_edit').html(options);
          } else {
            $.each(concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.concept + '</option>';
            });
            $(document).find('#admin_concept_for_sub_concept').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  var admin_category_for_sub_concept = $(document).find('#admin_category_for_sub_concept');

  if (admin_category_for_sub_concept.length > 0) {
    get_concepts(admin_category_for_sub_concept.val(), 'add', 0); //call function
  }

  $(document).on('change', '#admin_category_for_sub_concept', function () {
    get_concepts($(this).val(), 'add', 0); //call function
  });
  var admin_category_for_sub_concept_edit = $(document).find('#admin_category_for_sub_concept_edit');

  if (admin_category_for_sub_concept_edit.length > 0) {
    var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
    get_concepts(admin_category_for_sub_concept_edit.val(), 'edit', sub_concept_id); //call function
  }

  $(document).on('change', '#admin_category_for_sub_concept_edit', function () {
    var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
    get_concepts(admin_category_for_sub_concept_edit.val(), 'edit', sub_concept_id); //call function
  });
});

/***/ }),

/***/ "./resources/js/admin/types.js":
/*!*************************************!*\
  !*** ./resources/js/admin/types.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for types datatable

  $(function () {
    var datatable = $('#admin_types_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/admin/types-datatable',
      "columns": [{
        data: 'type',
        name: 'type'
      }, {
        data: 'sub_concept_id',
        name: 'sub_concept_id'
      }, {
        data: 'concept_id',
        name: 'concept_id'
      }, {
        data: 'category_id',
        name: 'category_id'
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
  }); //code for dynamic option in concept based on category

  function get_concepts_for_type(category_id, is_for, type_id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/admin/get-concepts-for-types',
      type: 'POST',
      data: {
        category_id: category_id,
        is_for: is_for,
        type_id: type_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          var concepts = data.concepts;
          var options = '';

          if (is_for == 'edit') {
            $.each(concepts, function (index, val) {
              if (data.selected_concept == val.id) {
                options += '<option value="' + val.id + '" selected>' + val.concept + '</option>';
              } else {
                options += '<option value="' + val.id + '">' + val.concept + '</option>';
              }
            });
            var admin_concept_edit_for_type = $(document).find('#admin_concept_edit_for_type');
            admin_concept_edit_for_type.html(options);
            var concept_id = admin_concept_edit_for_type.val();
            var type_id = $(document).find('#edit_type_span').attr('data-id');
            get_sub_concepts_for_type(concept_id, 'edit', type_id); //call function
          } else {
            $.each(concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.concept + '</option>';
            });
            var admin_concept_for_type = $(document).find('#admin_concept_for_type');
            admin_concept_for_type.html(options);
            var concept_id = admin_concept_for_type.val();
            get_sub_concepts_for_type(concept_id, 'add', 0); //call function
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  var admin_category_for_type = $(document).find('#admin_category_for_type');

  if (admin_category_for_type.length > 0) {
    get_concepts_for_type(admin_category_for_type.val(), 'add', 0); //call function
  }

  $(document).on('change', '#admin_category_for_type', function () {
    get_concepts_for_type($(this).val(), 'add', 0); //call function
  });
  var admin_category_edit_for_type = $(document).find('#admin_category_edit_for_type');

  if (admin_category_edit_for_type.length > 0) {
    var type_id = $(document).find('#edit_type_span').attr('data-id');
    get_concepts_for_type(admin_category_edit_for_type.val(), 'edit', type_id); //call function
  }

  $(document).on('change', '#admin_category_edit_for_type', function () {
    var type_id = $(document).find('#edit_type_span').attr('data-id');
    get_concepts_for_type($(this).val(), 'edit', type_id); //call function
  }); //code for dynamic option in sub concept based on concept

  function get_sub_concepts_for_type(concept_id, is_for, type_id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/admin/get-sub-concepts-for-types',
      type: 'POST',
      data: {
        concept_id: concept_id,
        is_for: is_for,
        type_id: type_id
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
            $(document).find('#admin_sub_concept_edit_for_type').html(options);
          } else {
            $.each(sub_concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.sub_concept + '</option>';
            });
            $(document).find('#admin_sub_concept_for_type').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  $(document).on('change', '#admin_concept_for_type', function () {
    get_sub_concepts_for_type($(this).val(), 'add', 0); //call function
  });
  $(document).on('change', '#admin_concept_edit_for_type', function () {
    var type_id = $(document).find('#edit_type_span').attr('data-id');
    get_sub_concepts_for_type($(this).val(), 'edit', type_id); //call function
  });
  /**
   * code for save types 
   */

  $(document).on('click', '#save_types', function () {
    $(document).find('#admin_types_form').submit();
  });
  $(document).on('click', '._remove_type_image', function () {
    var data_id = $(this).attr('data-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/admin/delete-type-image',
      type: 'POST',
      data: {
        id: data_id
      },
      cache: false,
      success: function success(response) {
        if (response.success) {
          $(document).find('._parent_type_' + data_id).remove();
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }); //REMOVE ADDED IMAGE IN ADD

  $(document).on('click', '._remove_type_image', function () {
    var div_id = $(this).attr('data-id');
    $(document).find('.' + div_id).remove();
  });
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/admin.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\worksheetgenerator\resources\js\admin.js */"./resources/js/admin.js");


/***/ })

/******/ });