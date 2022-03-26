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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/superadmin.js":
/*!************************************!*\
  !*** ./resources/js/superadmin.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// code for remove alert message after 5 seconds
$(document).ready(function () {
  var alert_exist = $(document).find('.alert').length;

  if (alert_exist > 0) {
    $('.alert').delay(4000).fadeOut();
  } //custom messages


  window.custom_alert = function (message, type) {
    if (type == 'success') {
      $(document).find('#custom_alerts').append('<div class="alert alert-success alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + '<i class="fa fa-check-circle"></i>' + '<span style="margin-left:10px;">' + message + '</span>' + '</div>');
    } else {
      $(document).find('#custom_alerts').append('<div class="alert alert-danger alert-dismissible" role="alert">' + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + '<i class="fa fa-times-circle"></i>' + '<span style="margin-left:10px;">' + message + '</span>' + '</div>');
    }

    $(document).scrollTop(0);
    setTimeout(function () {
      $('.alert').delay(4000).fadeOut();
    }, 1000);
  };
});

__webpack_require__(/*! ../js/superadmin/categories */ "./resources/js/superadmin/categories.js");

__webpack_require__(/*! ../js/superadmin/concepts */ "./resources/js/superadmin/concepts.js");

__webpack_require__(/*! ../js/superadmin/types */ "./resources/js/superadmin/types.js");

__webpack_require__(/*! ../js/superadmin/sub_concept */ "./resources/js/superadmin/sub_concept.js");

__webpack_require__(/*! ../js/superadmin/generate_worksheet */ "./resources/js/superadmin/generate_worksheet.js");

__webpack_require__(/*! ../js/superadmin/admins */ "./resources/js/superadmin/admins.js");

/***/ }),

/***/ "./resources/js/superadmin/admins.js":
/*!*******************************************!*\
  !*** ./resources/js/superadmin/admins.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for admins datatable

  $(function () {
    var datatable = $('#superadmin_admins_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/admins-datatable',
      "columns": [{
        data: 'name',
        name: 'name'
      }, {
        data: 'status',
        name: 'status'
      }, {
        data: 'is_verified',
        name: 'is_verified'
      }, {
        data: 'category_access',
        name: 'category_access'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove admin

  $(document).on('click', '._remove_admin', function () {
    $('#admin_delete_modal').show();
    $(document).find('#admin_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#admin_delete_modal').hide();
  }); //change the status of admin

  $(document).on('change', '#status_admin_select', function () {
    var status = $(this).val();
    var admin_id = $(document).find('#admin_id_span').html();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/superadmin/change-admin-status',
      type: 'POST',
      data: {
        status: status,
        admin_id: admin_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          custom_alert(data.message, 'success'); //global function called   
        } else {
          $(document).find('#status_admin_select').val(0);
          custom_alert(data.message, 'error'); //global function called
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  });
  /**---------------------------------------------------------------
   * CODE FOR CATEGORIES ACCESS 
   -----------------------------------------------------------------*/

  $(document).on('change', '._category_checkbox', function () {
    var checkox = $(this);
    var status = 0;

    if (checkox.prop('checked')) {
      status = 1;
    }

    var category_id = $(this).val();
    var admin_id = $(document).find('#admin_id').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/superadmin/access-category-status',
      type: 'POST',
      data: {
        status: status,
        admin_id: admin_id,
        category_id: category_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          if (status == 1) {
            checkox.parent().removeClass('access-danger');
            checkox.parent().addClass('access-success');
          } else {
            checkox.parent().removeClass('access-success');
            checkox.parent().addClass('access-danger');
          }

          custom_alert(data.message, 'success'); //global function called   
        } else {
          custom_alert(data.message, 'error'); //global function called
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }); //display message if user is not verified email then no access to access category button

  $(document).on('click', '._no_access_category', function () {
    custom_alert("User email not verified, So you can't give access of categories", 'error'); //global function called
  }); //if not requested category 

  $(document).on('click', '._not_requested_category', function () {
    $(this).parent().remove();
    var status = 0;

    if ($(this).prop('checked')) {
      status = 1;
    }

    var category_id = $(this).val();
    var category_name = $(this).attr('data-name');
    var admin_id = $(document).find('#admin_id').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/superadmin/access-category-status',
      type: 'POST',
      data: {
        status: status,
        admin_id: admin_id,
        category_id: category_id
      },
      cache: false,
      success: function success(data) {
        if (data.success) {
          $(document).find('#accessable_category_div').append('<div class="col-md-2 access-success" style="margin-top:10px;">' + '<input id="category_chbx_' + category_id + '" type="checkbox" class="_category_checkbox category-access-checkbox" name="category" value="' + category_id + '" checked>' + '<label for="category_chbx_' + category_id + '" style="font-size:16px;cursor:pointer;">' + category_name + '</label>' + '</div>');
          custom_alert(data.message, 'success'); //global function called   
        } else {
          custom_alert(data.message, 'error'); //global function called
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }); //select all categories

  $(document).on('change', '#select_all_categories', function () {
    var checked = $(this).prop('checked');

    if (checked) {
      $(document).find('._category_add').prop('checked', true);
    } else {
      $(document).find('._category_add').prop('checked', false);
    }
  }); //check all selected

  $(document).on('change', '._category_add', function () {
    var unchecked_count = 0;
    $(document).find('._category_add').each(function () {
      if (!$(this).prop('checked')) {
        unchecked_count++;
      }
    });

    if (unchecked_count < 1) {
      $(document).find('#select_all_categories').prop('checked', true);
    } else {
      $(document).find('#select_all_categories').prop('checked', false);
    }
  });
});

/***/ }),

/***/ "./resources/js/superadmin/categories.js":
/*!***********************************************!*\
  !*** ./resources/js/superadmin/categories.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for categories datatable

  $(function () {
    var datatable = $('#superadmin_categories_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/categories-datatable',
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

/***/ "./resources/js/superadmin/concepts.js":
/*!*********************************************!*\
  !*** ./resources/js/superadmin/concepts.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for concepts datatable

  $(function () {
    var datatable = $('#superadmin_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/concepts-datatable',
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

/***/ "./resources/js/superadmin/generate_worksheet.js":
/*!*******************************************************!*\
  !*** ./resources/js/superadmin/generate_worksheet.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for worksheet datatable

  $(function () {
    var datatable = $('#superadmin_worksheets_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/worksheets-datatable',
      "columns": [{
        data: 'title',
        name: 'title'
      }, {
        data: 'action',
        name: 'action'
      }]
    });
  }); // code for remove worksheet

  $(document).on('click', '._remove_worksheet', function () {
    $('#worksheet_delete_modal').show();
    $(document).find('#worksheet_id').val($(this).attr('data-id'));
  });
  $(document).on('click', '.close', function () {
    $('#worksheet_delete_modal').hide();
  }); //code for select all question

  $(document).on('change', '#check_all', function () {
    var checked = $(this).prop('checked');

    if (checked) {
      $(document).find('._question_checkbox').prop('checked', true);
    } else {
      $(document).find('._question_checkbox').prop('checked', false);
    }
  });
  $(document).on('change keyup', '#title_worksheet', function () {
    $(document).find('#worksheet_title').val($(this).val());
  });
  /**----------------------------------------------------------------------
   * CODE FOR CATEGORY BASED DYNAMIC OPTIONS
   ------------------------------------------------------------------------*/

  function get_category(category_id) {
    if (category_id == '') {
      $(document).find('#concept_filter').val('');
      $(document).find('#sub_concept_filter').val('');
      $(document).find('#type_filter').val('');
    } else {
      console.log('category_id::', category_id);
    }
  }

  var category_filter = $(document).find('#category_filter');

  if (category_filter.length > 0) {
    get_category(category_filter.val()); //function called
  }

  category_filter.on('change', function () {
    console.log('category_id_change::', $(this).val());
  });
});

/***/ }),

/***/ "./resources/js/superadmin/sub_concept.js":
/*!************************************************!*\
  !*** ./resources/js/superadmin/sub_concept.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for sub-concepts datatable

  $(function () {
    var datatable = $('#superadmin_sub_concepts_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/sub-concepts-datatable',
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
      url: baseUrl + '/superadmin/get-concepts',
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
            $(document).find('#superadmin_concept_edit').html(options);
          } else {
            $.each(concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.concept + '</option>';
            });
            $(document).find('#superadmin_concept').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  var superadmin_category = $(document).find('#superadmin_category');

  if (superadmin_category.length > 0) {
    get_concepts(superadmin_category.val(), 'add', 0); //call function
  }

  $(document).on('change', '#superadmin_category', function () {
    get_concepts($(this).val(), 'add', 0); //call function
  });
  var superadmin_category_edit = $(document).find('#superadmin_category_edit');

  if (superadmin_category_edit.length > 0) {
    var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
    get_concepts(superadmin_category_edit.val(), 'edit', sub_concept_id); //call function
  }

  $(document).on('change', '#superadmin_category_edit', function () {
    var sub_concept_id = $(document).find('#edit_sub_concept_span').attr('data-id');
    get_concepts(superadmin_category_edit.val(), 'edit', sub_concept_id); //call function
  });
});

/***/ }),

/***/ "./resources/js/superadmin/types.js":
/*!******************************************!*\
  !*** ./resources/js/superadmin/types.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // code for get base url
  var baseUrl = window.location.origin; // code for types datatable

  $(function () {
    var datatable = $('#superadmin_types_table').DataTable({
      processing: true,
      serverSide: true,
      order: [[1, 'asc']],
      ajax: baseUrl + '/superadmin/types-datatable',
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
      url: baseUrl + '/superadmin/get-concepts-for-types',
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
            var superadmin_concept_edit_for_type = $(document).find('#superadmin_concept_edit_for_type');
            superadmin_concept_edit_for_type.html(options);
            var concept_id = superadmin_concept_edit_for_type.val();
            var type_id = $(document).find('#edit_type_span').attr('data-id');
            get_sub_concepts_for_type(concept_id, 'edit', type_id); //call function
          } else {
            $.each(concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.concept + '</option>';
            });
            var superadmin_concept_for_type = $(document).find('#superadmin_concept_for_type');
            superadmin_concept_for_type.html(options);
            var concept_id = superadmin_concept_for_type.val();
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
  var superadmin_category_for_type = $(document).find('#superadmin_category_for_type');

  if (superadmin_category_for_type.length > 0) {
    get_concepts_for_type(superadmin_category_for_type.val(), 'add', 0); //call function
  }

  $(document).on('change', '#superadmin_category_for_type', function () {
    get_concepts_for_type($(this).val(), 'add', 0); //call function
  });
  var superadmin_category_edit_for_type = $(document).find('#superadmin_category_edit_for_type');

  if (superadmin_category_edit_for_type.length > 0) {
    var type_id = $(document).find('#edit_type_span').attr('data-id');
    get_concepts_for_type(superadmin_category_edit_for_type.val(), 'edit', type_id); //call function
  }

  $(document).on('change', '#superadmin_category_edit_for_type', function () {
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
      url: baseUrl + '/superadmin/get-sub-concepts-for-types',
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
            $(document).find('#superadmin_sub_concept_edit_for_type').html(options);
          } else {
            $.each(sub_concepts, function (index, val) {
              options += '<option value="' + val.id + '">' + val.sub_concept + '</option>';
            });
            $(document).find('#superadmin_sub_concept_for_type').html(options);
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  ;
  $(document).on('change', '#superadmin_concept_for_type', function () {
    get_sub_concepts_for_type($(this).val(), 'add', 0); //call function
  });
  $(document).on('change', '#superadmin_concept_edit_for_type', function () {
    var type_id = $(document).find('#edit_type_span').attr('data-id');
    get_sub_concepts_for_type($(this).val(), 'edit', type_id); //call function
  }); //code for multiple file upload with preview

  var filesArray = [];
  var i = 1;
  $(document).on('change', '.image_file_type', function (e) {
    if ($(this)[0].files[0]) {
      var extension_array = ['png', 'jpg', 'jpeg', 'gif'];
      var fileName = e.target.files[0].name;
      var file_extension = fileName.substr(fileName.indexOf(".") + 1);

      if ($.inArray(file_extension, extension_array) == -1) {
        alert('Please select only image file.');
        $(this).val('');
        return;
      }

      $(this).parent().parent().hide();
      var reader = new FileReader();

      reader.onload = function (e) {
        $(document).find('#image_list').append('<div class="col-md-3 type-image type-image-main _add_type_image_' + i + '">' + '<div class="type-image-div">' + '<img src="' + e.target.result + '"/>' + '<div class="type-image-trash">' + '<i data-id="_add_type_image_' + i + '" class="fa fa-trash _remove_type_image" style="cursor: pointer;"></i>' + '</div>' + '</div>' + '</div>' + '<div class="col-md-3 upload-btn-div _add_type_image_' + (i + 1) + '">' + '<div class="upload-btn-wrapper">' + '<button class="btn-upload">Upload a file</button>' + '<input id="file_upload" class="image_file_type" type="file" name="images[]">' + '</div>' + '</div>');
        i++;
      };

      reader.readAsDataURL($(this)[0].files[0]);
    }
  });
  /**
   * code for save types 
   */

  $(document).on('click', '#save_types', function () {
    $(document).find('#superadmin_types_form').submit();
  });
  $(document).on('click', '._remove_type_image', function () {
    var data_id = $(this).attr('data-id');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/superadmin/delete-type-image',
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

/***/ 1:
/*!******************************************!*\
  !*** multi ./resources/js/superadmin.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\worksheetgenerator\resources\js\superadmin.js */"./resources/js/superadmin.js");


/***/ })

/******/ });