Dropzone.options.addImages = {
    maxFilesize: 5, //MB
    acceptedFiles: 'image/*',
    success: function (file, response) {
        if (file.status == 'success') {
            handleDropzoneFileUpload.handleSuccess(response);
        } else {
            handleDropzoneFileUpload.handleError(response);
        }
    }
};

var handleDropzoneFileUpload = {
    handleError: function (response) {
        console.log(response);
    },
    handleSuccess: function (response) {
        var imageList = $('#gallery-images ul');
        var image = baseUrl + '/storage/imgs/serviceImages/thumbs/' + response.file_name;
        $(imageList).append('<li><a href="' + image + '"><img src="' + image + '"></a></li>');
    }
};
