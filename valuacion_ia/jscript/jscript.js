$.ajax({
    type: "get",
    url: "https://app.intelimotor.com/api/brands?apiKey=58ddf99f8dc571619bcb9603b8eaa7467c2f0db3e78769c63dbc568d4f35507e&apiSecret=af004273051c09189c70be7a50768d85d6574b570cc999fe0577a9f9e6173551",
    data: "",
    dataType: "json",
    success: function (response) {
        console.log(response);
    }
});