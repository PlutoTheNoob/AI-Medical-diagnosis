<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Information Form</title>
    <style>
        label {
            font-size: 14px;
            color: #333;
            margin-top: 10px;
            display: block;
            text-align: left;
        }
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

        /* Hide the pregnancy question initially */
        #pregnancyQuestion {
            display: none;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Please provide us with the required information.</h1>
        
        <label for="gender" id="genderLabel">What is your gender?</label>
        <select name="gender" id="gender">
            <option value="0">Male</option>
            <option value="1">Female</option>
        </select>
        <br>

        <label for="age" id="ageLabel">Are you above 60 years old?</label>
        <select name="age" id="age">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <label for="cough" id="coughLabel">Do you cough a lot?</label>
        <select name="cough" id="cough">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <label for="fever" id="feverLabel">Do you have a fever?</label>
        <select name="fever" id="fever">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <label for="st" id="stLabel">Do you have a sore throat?</label>
        <select name="st" id="st">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <label for="sob" id="sobLabel">Do you have shortness of breath?</label>
        <select name="sob" id="sob">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <label for="ha" id="haLabel">Do you have a headache?</label>
        <select name="ha" id="ha">
            <option value="0">Yes</option>
            <option value="1">No</option>
        </select>
        <br>

        <!-- Hidden pregnancy question initially -->
        <div id="pregnancyQuestion">
            <label for="pregnant" id="pregnantLabel">Are you pregnant?</label>
            <select name="pregnant" id="pregnant">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div><button onclick=showtreat()>Show treatment</button></div>
    </div>

    <script>


        function showtreat(){

       
                window.location.href="https://d982-154-180-148-86.ngrok-free.app/cdcd.php";        


        }
        
        document.getElementById("gender").addEventListener("change", function() {
            var gender = this.value;
            var pregnancyQuestion = document.getElementById("pregnancyQuestion");

            // Show pregnancy question if female (gender = 1)
            if (gender == "1") {
                pregnancyQuestion.style.display = "block";
            } else {
                pregnancyQuestion.style.display = "none";
            }
        });
    </script>
</body>
</html>
