const host = "https://provinces.open-api.vn/api/";

function callAPI(api) {
  return fetch(api)
    .then(response => response.json())
    .then(data => {
      renderData(data, "province");
      setDefaultDistrict(data[0].code); // Set default district based on the first province
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function callApiDistrict(api, defaultDistrictCode) {
  return fetch(api)
    .then(response => response.json())
    .then(data => {
      renderData(data.districts, "district");
      setDefaultWard(data.districts[0].code); // Set default ward based on the first district
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function callApiWard(api) {
  return fetch(api)
    .then(response => response.json())
    .then(data => {
      renderData(data.wards, "ward");
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function renderData(array, select) {
  let options = '<option disabled value="">chọn</option>';
  array.forEach(element => {
    options += `<option value="${element.code}">${element.name}</option>`;
  });
  $("#" + select).html(options);
}

$(document).ready(function() {
  // Call the API to fetch and render the provinces
  callAPI(host + "?depth=1");

  // Province change event
  $("#province").change(function() {
    var selectedProvinceCode = $(this).val();
    if (selectedProvinceCode) {
      var api = host + "p/" + selectedProvinceCode + "?depth=2";
      callApiDistrict(api, "");
    } else {
      $("#district").html('<option disabled value="">chọn</option>');
      $("#ward").html('<option disabled value="">chọn</option>');
    }
    updateResultText();
  });

  // District change event
  $("#district").change(function() {
    var selectedDistrictCode = $(this).val();
    if (selectedDistrictCode) {
      var api = host + "d/" + selectedDistrictCode + "?depth=2";
      callApiWard(api);
    } else {
      $("#ward").html('<option disabled value="">chọn</option>');
    }
    updateResultText();
  });

  // Ward change event
  $("#ward").change(function() {
    updateResultText();
  });

  // Function to set the default value for district
  function setDefaultDistrict(provinceCode) {
    const defaultDistrictApi = host + "p/" + provinceCode + "?depth=2";
    fetch(defaultDistrictApi)
      .then(response => response.json())
      .then(data => {
        renderData(data.districts, "district");
        setDefaultWard(data.districts[0].code); // Set default ward based on the first district
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  // Function to set the default value for ward
  function setDefaultWard(districtCode) {
    const defaultWardApi = host + "d/" + districtCode + "?depth=2";
    fetch(defaultWardApi)
      .then(response => response.json())
      .then(data => {
        renderData(data.wards, "ward");
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  // Function to update the result text
  function updateResultText() {
    var province = $("#province option:selected").text();
    var district = $("#district option:selected").text();
    var ward = $("#ward option:selected").text();

    var resultText =ward+" , "+ district+ " , " + province;
    $("#result_local").val(resultText);
  }
});
