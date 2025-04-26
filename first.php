<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    if(empty($_SESSION['Username'])){
        header('Location: https://d982-154-180-148-86.ngrok-free.app/login%20page.php');
    }




    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Image Prediction</title>
    <style>
        label {
            font-size: 14px;
            color: #333;
            margin-top: 10px;
            display: block;
            text-align: left;
        }
        /* Styling for the select elements */
        select {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            width: 100%;
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #333;
        }
        input[type="file"] {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        #output {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        /* Hide the link initially */
        #treatmentLink {
            display: none;
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
        }

        #treatmentLink:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload an Image for Prediction</h2>
        <input type="file" id="fileInput" accept="image/*">
        <br>
        <button onclick="getAIResponse()">Predict</button>
        <p id="output"></p>
        <a href="https://d982-154-180-148-86.ngrok-free.app/treatment.php" id="treatmentLink">See our recommendation for treatment?</a>
        <a href="https://d982-154-180-148-86.ngrok-free.app/feedback.php"  id="feedbacklink">Give us a feedback!</a>
        
    </div>

    <script>
        const selects = document.querySelectorAll("select");
        selects.forEach(select => {
            select.onchange = function() {
                console.log(select.value);  // Log the selected value
            }
        });

        const BACKEND_URL = "https://e15f-154-180-148-86.ngrok-free.app/predict/"; // Replace with your ngrok backend URL

        

        async function getAIResponse() {
            let fileInput = document.getElementById("fileInput").files[0];

            if (!fileInput) {
                alert("Please select an image first!");
                return;
            }

            let formData = new FormData();
            formData.append("file", fileInput);

            try {
                let response = await fetch(BACKEND_URL, {
                    method: "POST",
                    body: formData
                });

                let data = await response.json();
                document.getElementById("output").innerText = "Prediction: " + data.output;
                let prediction = data.output;
                let phpForm = new FormData();
                phpForm.append("output", prediction);
                phpForm.append("image", fileInput); 

                fetch('backresponse.php', {
                    method: "POST",
                    body: phpForm
                });

                if(data.output == "Covid"){
                    document.getElementById("treatmentLink").style.display = "block";
                }

            } catch (error) {
                document.getElementById("output").innerText = "Error: Could not connect to AI backend.";
                console.error("Error:", error);
            }


        }
    </script>
</body>
</html>
