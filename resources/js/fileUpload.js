function handleFile(file) {

    if (
        file.type == 'image/jpeg' ||
        file.type == 'image/png' ||
        file.type == 'image/jpg'
    ) {
        let reader = new FileReader()
        reader.onload = function (event) {
            $('#fileInfoBox').addClass('visible')
            $('#fileInfoBox').removeClass('invisible')
            $('#previewImg').attr('src', event.target.result).addClass('visible').removeClass('invisible')
        }
        reader.readAsDataURL(file)

        $('#inputFileName').html(file.name)

        let size = file.size
        size = Math.round((size / 1024).toFixed(2))

        if (size < 1024) {
            $('#inputFileSize').html(size + ' KB')
        } else {
            size = Math.round((size / 1024).toFixed(2))
            $('#inputFileSize').html(size + ' MB')
        }

    } else {
        $('#message').html('Please Upload Images Only')
    }
}

window.addEventListener('load', function () {
    myFileList.addEventListener('drop', dropHandler, false)
    myFileList.addEventListener(
        'dragover',
        function (ev) {
            ev.preventDefault()
        },
        false,
    )

    function dropHandler(ev) {
        ev.preventDefault()
        var filelist = ev.dataTransfer.files
        for (var i = 0, f;
            (f = filelist[i]); i++) {
            var reader = new FileReader()
            reader.onload = (function (theFile) {
                handleFile(theFile)
                document.querySelector('#fileup').files = theFile;
            })(f)
            break
        }
    }
})

$(document).ready(function () {
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            handleFile(input.files[0])
        }
    }
    $('#fileUploadInput').on('change', function () {
        readURL(this)
    })
    $('#myFileList').on('click', function () {
        $('#fileUploadInput').click()
    })

    $("#removeInputFileButton").on("click", function () {
        $('#fileInfoBox').addClass('invisible')
        $('#fileInfoBox').removeClass('visible')
        $('#fileInfoBox').html('')

        $("#previewImg").attr("src", "").addClass("invisible");
        $("#file-input").val("");
    });

})
