const host = "https://provinces.open-api.vn/api/";

$(document).ready(function() {

  // Fetch and render the provinces
  callAPI(host + "?depth=1");

  // Function to fetch provinces
  function callAPI(api) {
    $.getJSON(api)
      .done(function(data) {
        renderData(data, "province");

        // Set the default district and ward values for the first province
        var firstProvinceCode = data[0].code;
        var firstProvinceApi = host + "p/" + firstProvinceCode + "?depth=2";
        callApiDistrict(firstProvinceApi);
      })
      .fail(function(error) {
        console.error('Error:', error);
      });
  }

  // Function to fetch districts
  function callApiDistrict(api) {
    $.getJSON(api)
      .done(function(data) {
        renderData(data.districts, "district");

        // Set the default ward value for the first district
        var firstDistrictCode = data.districts[0].code;
        var firstDistrictApi = host + "d/" + firstDistrictCode + "?depth=2";
        callApiWard(firstDistrictApi);
      })
      .fail(function(error) {
        console.error('Error:', error);
      });
  }

  // Function to fetch wards
  function callApiWard(api) {
    $.getJSON(api)
      .done(function(data) {
        renderData(data.wards, "ward");

        // Update the result text with the default values
        updateResultText();
      })
      .fail(function(error) {
        console.error('Error:', error);
      });
  }

  // Function to render data in select options
  function renderData(array, select) {
    var options = '<option disabled value="">chọn</option>';
    $.each(array, function(index, element) {
      options += '<option value="' + element.code + '">' + element.name + '</option>';
    });
    $("#" + select).html(options);
  }

  // Function to update the result text
  function updateResultText() {
    var province = $("#province option:selected").text();
    var district = $("#district option:selected").text();
    var ward = $("#ward option:selected").text();

    var resultText = province + " , " + district + " , " + ward;
    $("#result_local").val(resultText);
  }

  // Province change event
  $("#province").change(function() {
    var selectedProvinceCode = $(this).val();
    if (selectedProvinceCode) {
      var api = host + "p/" + selectedProvinceCode + "?depth=2";
      callApiDistrict(api);
    } else {
      $("#district").html('<option disabled value="">chọn</option>');
      $("#ward").html('<option disabled value="">chọn</option>');
    }
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
  });

  // Ward change event
  $("#ward").change(function() {
    // printResult();
  });

  // Update result text on select change
  $("#province, #district, #ward").change(function() {
    updateResultText();
  });
     
})
