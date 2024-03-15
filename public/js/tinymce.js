document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: "textarea#default",
        width: "100%",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste code help wordcount",
            "link",
            "lists",
        ],
        toolbar:
            "undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image |help",
        content_style:
            "body { font-family: Arial, sans-serif; font-size: 14px; }",
    });
});
