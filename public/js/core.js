/*
 * DWAdmin
 */

/*
 * this is the javascipt for the dwadmin template.
 * if you want to change, please create a new javascript,
 * because if one is missing in the original dwadmin javascript it will fall apart
 */

const baseUrl = "http://127.0.0.1:8000/";

const dataTable = (tableId) => {
  let data = $(`#${tableId}`).DataTable({
    responsive: true
  });

  return data;
}

let numberInput = document.getElementsByClassName("number-format");
for (let i = 0; i < numberInput.length; i++) {
  numberInput[i].addEventListener("keyup", function() {
    this.value = numberFormat(this.value);
  })
}
// numberInput.on("keyup", function() {
//   this.value = numberFormat(this.value);
// });

const getDataEdit = (link, modalId) => {
	let inputEdit = document.getElementsByClassName("input-edit");
  $.ajax({
    url: `${baseUrl}${link}`,
    type: "GET",
    cache: false,
    dataType: "JSON",
    success: function(result) {
      $(`#${modalId}`).modal("show");
      // console.log(result.data);
      if (result.success == 200) {
        for (let i = 0; i < inputEdit.length; i++) {
          for (const [key, value] of Object.entries(result.data)) {
            if (inputEdit[i].name == key) {
              inputEdit[i].value = value;
            }
          }
        }
      } else if (result.success == 201) {
        sweet("error", "Gagal!", result.message);
      } else {
        window.location.href = result.link;
      }
    }
  })
}

const showModal = (modalId) => {
  $(`#${modalId}`).modal("show")
}

const navigateTo = (link, fromBreadcrumb = false) => {
  loadRequest();
  if (fromBreadcrumb === false) {
    window.location.href = `${baseUrl}${link}`;
  } else {
    // console.log(link);
    window.location.href = link;
  }
}

const searchItem = (input, listedId, link, csrfID = false) => {
  let dataPost = "";
  if (csrfID) {
    dataPost = {
      keyword: input.value,
      _token: document.getElementById(csrfID).value
    }
  } else {
    dataPost = {
      keyword: input.value
    }
  }
  $.ajax({
    url: `${baseUrl}${link}`,
    cache: false,
    type: "POST",
    data: dataPost,
    dataType: "JSON",
    success: function(result) {
      let tagListed = document.getElementById(listedId);
      if (result.success == 200) {
        tagListed.innerHTML = result.data;
      } else if (result.success == 201) {
        sweet("error", "Gagal!", result.message);
      } else {
        window.location.href = result.link;
      }
    }
  });
}

const hideResult = (listedId, inputId = "", resetInput = false) => {
  setTimeout(function() {
    document.getElementById(listedId).innerHTML = "";
    if (resetInput === true) {
      inputId.value = "";
    }
  }, 500);
}

const submitForm = (formId) => {
  loadRequest();
  $(formId).submit();
}

const goBack = () => {
  loadRequest();
  window.history.back();
}

const sendDataMovePage = (link, formId) => {
  loadRequest();
  let dataForm = document.getElementById(formId);
  $.ajax({
    url: link,
    type: "POST",
    data: new FormData(dataForm),
    processData: false,
    contentType: false,
    cache: false,
    dataType: "JSON",
    success: function(result) {
      if (result.success == 200) {
        window.location.href = result.link;
      } else if (result.success == 201) {
        finishRequest();
        $("[name='_token']").val(result.csrf_hash);
        sweet("error", "Gagal!", result.message);
      } else {
        window.location.href = result.link;
      }
    }
  })
}

const resetForm = (formId) => document.getElementById(formId).reset();

const resetInput = (inputId) => document.getElementById(inputId).value = "";

const sweet = (icon, title, text) => {
  Swal.fire({
    icon: icon,
    title: title,
    text: text
  })
}

const getDataTable = (tableId, link, customSort = false) => {
  let sort = customSort !== false ? {
    "aoColumns": customSort
  } : "";
  let dataTable = $(`#${tableId}`).DataTable({
    "responsive": true,
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      "url": `${baseUrl}${link}`,
      "type": "POST"
    },
    "columnDefs": [{
      "targets": [0],
      "orderable": false
    }],
    sort
  });

  return dataTable;
}

const getDataTableInput = (tableId, link, dataObject) => {
  let dataTable = $(`#${tableId}`).DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      "url": `${baseUrl}${link}`,
      "type": "POST",
      "data": dataObject
    },
    "columnDefs": [{
      "targets": [0],
      "orderable": false
    }]
  });

  return dataTable;
}

const dataTableInputHash = (tableId, link, dataObject, idCsrf) => {
  let dataTable = $(`#${tableId}`).DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    ajax: function(dataObject, link, idCsrf) {
      $.ajax({
        "url": `${baseUrl}${link}`,
        "type": "POST",
        "data": dataObject,
        success: function(result) {
          console.log(result);
        }
      })
    },
    "columnDefs": [{
      "targets": [0],
      "orderable": false
    }]
  });

  return dataTable;
}

const sendData = (formId, link, modalId, tableId) => {
  loadRequest();
  let dataForm = document.getElementById(formId);
  $.ajax({
    url: `${baseUrl}${link}`,
    type: "POST",
    data: new FormData(dataForm),
    processData: false,
    contentType: false,
    cache: false,
    dataType: "JSON",
    success: function(result) {
      finishRequest();
      $("[name='_token']").val(result.csrf_hash);
      if (result.success == 200) {
        $(`#${modalId}`).modal("hide");
        sweet("success", "Sukses!", result.message);
        tableId.ajax.reload();
        resetForm(formId);
      } else if (result.success == 201) {
        sweet("error", "Gagal!", result.message);
      } else {
        window.location.href = result.link;
      }
    }
  })
}

const sendDataWithError = (formId, link, modalId, tableId, insert = true) => {
  loadRequest();
  let dataForm = document.getElementById(formId);
  let errorMessage = document.getElementsByClassName("error-message");
  let input;
  if (insert) {
    input = document.getElementsByClassName("input-insert");
  } else {
    input = document.getElementsByClassName("input-edit");
  }
  // console.log(errorMessage)
  for (let i = 0; i < input.length; i++) {
    $(Object.values(errorMessage)).remove();
    input[i].classList.remove("is-invalid");
  }
  $.ajax({
    url: `${baseUrl}${link}`,
    type: "POST",
    data: new FormData(dataForm),
    processData: false,
    contentType: false,
    cache: false,
    dataType: "JSON",
    success: function(result) {
      finishRequest();
      // console.log(result.error);
      $("[name='_token']").val(result.csrf_hash);
      if (result.success == 200) {
        $(`#${modalId}`).modal("hide");
        sweet("success", "Sukses!", result.message);
        tableId.ajax.reload();
        resetForm(formId);

      } else if (result.success == 201) {
        sweet("error", "Gagal!", result.message);
        let input;
        if (insert) {
          input = document.getElementsByClassName("input-insert");
        } else {
          input = document.getElementsByClassName("input-edit");
        }
        let i = 0;
        for (const value in result.error) {
          console.log(value);
          for (let i = 0; i < input.length; i++) {
            if (input[i].name == value) {
              input[i].classList.add("is-invalid");
              let span = document.createElement("span");
              span.innerHTML = result.error[value][0];
              span.className = "text-danger error-message";
              // console.log(span);
              input[i].insertAdjacentElement("afterend", span);
            }
          }
        }

      } else {
        window.location.href = result.link;
      }
    }
  })
}

const promptAction = (link, message, table) => {
  Swal.fire({
    title: 'Anda yakin?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, lakukan ini!'
  }).then((result) => {
    if (result.value) {
      loadRequest();
      //  window.location.href = link;
      $.ajax({
        url: `${baseUrl}${link}`,
        type: "GET",
        cache: false,
        dataType: "JSON",
        success: function(result) {
          finishRequest();
          if (result.success == 200) {
            table.ajax.reload();
            sweet("success", "Sukses!", result.message);
          } else if (result.success == 201) {
            sweet("error", "Gagal!", result.message);
          } else {
            window.location.href = result.link;
          }
        },
        error: function() {
          finishRequest();
          Swal.fire({
            title: "Gagal!",
            text: "404 Not Found",
            icon: "error"
          })
        }
      })
    }
  })
}

const promptDeleteReloadPage = (link, message) => {
  Swal.fire({
    title: 'Anda yakin?',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, lakukan ini!'
  }).then((result) => {
    if (result.value) {
      loadRequest();
      window.location.href = baseUrl + link;
    }
  })
}

const numberFormat = (value) => {
  if (value.toString()[0] == "-") {
    var negative = "-";
  } else {
      negative = "";
  }
  var raw = value.toString().replace(/(?!\.)\D/g, "").split(".");
  var whole = raw[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var decimal = false;
  if (raw.length > 1) {
      decimal = raw[1];
  }
  if (decimal !== false && (decimal !== "0" || decimal !== "00")) {
      return negative + whole + "." + decimal;
  } else {
      return negative + whole;
  }
}

const promptDeleteItem = (link, tableId, csrfID) => {
  let csrf = document.getElementById(csrfID).value;
  Swal.fire({
    title: 'Anda yakin?',
    text: "Item ini akan dihapus secara permanent!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus ini!'
  }).then((result) => {
    if (result.value) {
      loadRequest();
      //  window.location.href = link;
      $.ajax({
        url: `${baseUrl}${link}`,
        type: "DELETE",
        data: {
          _token: csrf
        },
        cache: false,
        dataType: "JSON",
        success: function(result) {
          finishRequest();
          document.getElementById(csrfID).value = result.csrf_hash
          if (result.success == 200) {
            tableId.ajax.reload();
            sweet("success", "Sukses!", result.message);
          } else if (result.success == 201) {
            sweet("error", "Gagal!", result.message);
          } else {
            window.location.href = result.link;
          }
        },
        error: function() {
          finishRequest();
          Swal.fire({
            title: "Gagal!",
            text: "404 Not Found",
            icon: "error"
          })
        }
      })
    }
  })
}

const readerImage = (inputId, imgId) => {
  // resetFormImage(inputId, imgId);
  let input = document.getElementById(inputId);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById(imgId).src = e.target.result;
    }

    let tagImg = document.getElementById(imgId);
    let button = document.createElement("button");
    button.innerHTML = "Reset Image";
    button.className = "btn btn-danger btn-sm mb-2 delete-form-image";
    button.setAttribute("type", "button");
    button.setAttribute("onclick", `resetFormImage('${inputId}', '${imgId}')`);
    tagImg.parentNode.insertBefore(button, tagImg);

    reader.readAsDataURL(input.files[0]);
  }
}

const resetFormImage = (inputId, imgId) => {
  resetInput(inputId);
  let tagImg = document.getElementById(imgId);
  if (tagImg) {
    tagImg.src = "";
  }
  $(".delete-form-image").remove();
}

const loadRequest = () => document.getElementById("loadAjax").classList.remove("d-none");
const finishRequest = () => document.getElementById("loadAjax").classList.add("d-none");

function onErrorImage(target) {
  target.onerror = null;
  target.src = `${baseUrl}images/default_user.png`;
}

$(document).ready(function () {
	finishRequest();

	$("#sidebar-toggle, .sidebar-overlay").click(function () {
		$(".sidebar").toggleClass("sidebar-show");
		$(".sidebar-overlay").toggleClass("d-block");
	});

	$(".sidebar-items .submenu-items").click(function () {
		$(".sidebar-items .submenu-items").removeClass("active");
		$(this).toggleClass("active");
	});

	function clickMenu(goId, title) {
		$(goId).click(function (e) {
			e.preventDefault();

			$(".sidebar-items .items").removeClass("active");
			$(".sidebar-items .submenu a").removeClass("active");
			$(this).addClass("active");

		});
	}

});
localStorage.setItem('theme', 'dark');

window.console = window.console || function(t) {};
if (document.location.search.match(/type=embed/gi)) {
  window.parent.postMessage("resize", "*");
}

// console.log('Please activate dark mode, if you want to use it!');
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

document.documentElement.setAttribute('data-theme', 'dark');
localStorage.setItem('theme', 'dark');

const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;
if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
}
