$(document).ready(function() {
    $("#submitBtn").click(function(event) {
        const ownerName = $("#ownerName").val();
        const vehicleModel = $("#vehicleModel").val();
        const vehicleNumber = $("#vehicleNumber").val();
        const registrationDate = $("#registrationDate").val();
        const vehicleType = $("#vehicleType").val();

        if (!ownerName || !vehicleModel || !vehicleNumber || !registrationDate || !vehicleType) {
            alert("Please fill out all fields!");
            event.preventDefault();
        }
    });
});
