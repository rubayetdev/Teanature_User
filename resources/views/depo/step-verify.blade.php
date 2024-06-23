<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Information</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        .input-box {
            margin-bottom: 15px;
        }
        .input-box label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .input-box input[type="text"] {
            width: calc(100% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .input-box input[type="file"] {
            width: calc(100% - 10px);
            padding: 10px;
        }
        .preview-image {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            display: none;
            width: 300px; /* Set the width here */
            height: auto; /* Maintain aspect ratio */
        }
        .button {
            text-align: center;
        }
        .button input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">Owner Information</div>
    <form action="{{route('owner-verfication')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
        <div class="input-box">
            <label for="owner-name">Owner Name</label>
            <input type="text" id="owner-name" name="owner_name" placeholder="Enter owner name" required>
        </div>
        <div class="input-box">
            <label for="trade-lic">Trade License</label>
            <input type="text" id="trade-lic" name="lic" placeholder="Enter Trade License" required>
        </div>

        <div class="input-box">
            <label for="nid-front">NID Front</label>
            <input type="file" id="nid-front" name="nidfront" accept=".jpg, .jpeg" required onchange="previewImage('nid-front', 'nid-front-preview')">
            <img id="nid-front-preview" class="preview-image" src="#" alt="NID Front Preview">
        </div>
        <div class="input-box">
            <label for="nid-back">NID Back</label>
            <input type="file" id="nid-back" name="nidback" accept=".jpg, .jpeg" required onchange="previewImage('nid-back', 'nid-back-preview')">
            <img id="nid-back-preview" class="preview-image" src="#" alt="NID Back Preview">
        </div>
        <div class="input-box">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter Address" required>
        </div>
        <div class="input-box">
            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="Enter City" required>
        </div>
        <div class="button">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>
<script>
    function previewImage(inputId, imageId) {
        const input = document.getElementById(inputId);
        const image = document.getElementById(imageId);
        const file = input.files[0];
        if (file.type === 'image/jpeg' || file.type === 'image/jpg') {
            const reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;
                image.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            alert('Please select a JPEG/JPG image.');
            input.value = '';
            image.style.display = 'none';
        }
    }
</script>
</body>
</html>
