<?php
// index.php

// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Empty password
$dbname = "bussiness_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is for data
if (isset($_GET['action']) && $_GET['action'] === 'getData') {
    // Query to get the data
    $sql = "SELECT Protiens, Fats, Carbs FROM nutrients LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $data = array(
            'Protiens' => $row['Protiens'],
            'Fats' => $row['Fats'],
            'Carbs' => $row['Carbs']
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'No data found'));
    }
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #error-message {
            color: red;
            font-weight: bold;
            display: none;
        }
        /* Adjust size of the chart */
        #myPieChart {
            max-width: 350px; /* Set maximum width */
            max-height: 350px; /* Set maximum height */
            width: 100%; /* Make it responsive */
            height: auto; /* Maintain aspect ratio */
            align-items: center;

        }

        /* #chart-container {
            text-align: center;
            width: 500px;  /* Set smaller width 
            height: fit-content; /* Set smaller height 
            margin: 80px auto; /* Centering the chart on the page 
            padding-bottom: 50px;
            margin-bottom: 100px;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.712);
            font-weight: 300;
            color: black;
            align-items: center;

            
        } */

        #chart-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 500px;  /* Set smaller width */
    height: fit-content; /* Set smaller height */
    margin: 80px auto; /* Centering the container horizontally */
    padding-bottom: 50px;
    margin-bottom: 50px;
    margin-top: 50px;
    background-color: rgba(255, 255, 255, 0.712);
    font-weight: 300;
    color: black;
    flex-direction: column;
}


        .heading
        {
          /* font-family: 'Times New Roman', Times, serif; */
          font-family: "Bodoni MT", serif;
          font-weight: 100;
          font-size: 100px;
          text-decoration: wavy;
          margin-bottom: 80px;
          margin-top: 40px;
          width: 1200px;

        }

        .variety
        {
          display: flex;
          flex-direction: row;
          gap: 30px;
          /* background-color: rgba(255, 255, 255, 0.56);   */
          margin-top: 100px;
          margin-bottom: 50px;
          font-family: "Courier New", Courier, monospace;
          font-size: 98px;
          border-radius: 80px;
          width: fit-content;
          color: darkgreen;
          font-weight: 50;
        }

        .variety img
        {
          border-radius: 50%;
          height: 350px;
          width: 350px;
        }

        .upper.textp{
            background-color: antiquewhite;
            border-radius: 20px;
            height: auto;
            width: auto;
            padding: 10px;
            margin-bottom: 10px;
            

        }
      
        .upperp{
          display: flex;
            /* background-color: antiquewhite;  */
           background-color: rgba(255, 255, 255, 0.56); 
            border-radius: 20px;
            height: fit-content;
            width: 700px;
            padding: 15px;
            margin-bottom: 10px;
            justify-content: center;
            font-weight: 500;
            font-size: 20px;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border-radius: 110px;
            margin-left: 40px;
            padding-left: 20px;
            padding-right: 10px;
        }

        .upperp img{
         
          
          width: 250px;
          height: 250px;
          padding: 20px;
        }

        .textp h2
        {
          font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
          color: goldenrod;
        }

        /* .menuhead
        {
          font-family: "Courier New", Courier, monospace;
          font-size: 98px;
          border-radius: 80px;
          width: fit-content;
          /* color: darkgreen; 
          font-weight: 50;
          align-items: center;
          text-align: center;
          justify-content: center;

        } */

        .menuhead 
        {
          font-family: "Courier New", Courier, monospace;
          font-size: 150px;
          border-radius: 80px;
          width: 100%; /* Full width to help center text */
          font-weight: 70;
          text-align: center; /* Center text horizontally within the element */
          margin-bottom: 50px;
        }


        .inline-img 
        {
          vertical-align: middle; /* Aligns the image to the middle of the text line */
          margin: 0; /* Removes any default margin */
          padding: 0; /* Removes any default padding */
          border-radius: 50%;
          width: 150px;
          padding: 10px;
        }
        
        
         .items{
              display: flex; 
              justify-content: center;
              margin-bottom: 20px; 
              background-color: beige;
              /* text-align: center;  */
              padding: 15px;
              height: auto;
              width: auto;
              border-radius: 10px;
            /* flex-wrap: wrap; */
        } 

        .items h3{
 
            
            text-align: center;
            color: goldenrod;
        }

        /* .items .Menu
        {
                justify-content: center;
                border-radius: 8px;
                background-color: rgba(255, 255, 255, 0.5);
                text-decoration-color: aliceblue;
                margin: 0 30px;
                 /* text-align: center; 
                height: auto;
                width: auto;
                padding: 4px ;
                display: flex; 
                /* color: rgba(180, 119, 27, 0.623); */
                 /* align-items: center;  
                flex-direction: column;
                margin-bottom: 30px;
                margin-top: 30px;

        } */

        /* .Menu img{
            max-width: 100%;
            align-items: center;
            border-radius: 10px;
            height:210px;
        } */

       /* body{
        background-image: url('C:\Users\YASHICA\Downloads\vegetables.jpeg');
       } */

       body {
    background-image: url('vegetables1.jpeg');
          /* background-size: cover; 
          background-position: center; 
          background-repeat: no-repeat; */
          background-repeat: repeat;
      background-size: cover;
      background-position: center;
  
       
}

        

.nutrition-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.nutrition-title {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.nutrition-values {
  display: flex;
  gap: 20px;
  flex-direction: row;
}

.nutrition-value {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.nutrition-value-circle {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  flex-direction: row;
}

.nutrition-value-label {
  font-size: 12px;
  margin-top: 5px;
}

.menu-container {
            position: relative;
            width: 100%;
            /* max-width: 800px; Adjust as needed */
            max-width: auto;
            /* margin: auto; */
            margin: 20px;
            overflow: hidden;
           display: flex;
           flex-direction: column;
        }

        .menu-wrapper {
            display: flex;
            transition: transform 0.5s ease;
        }

        .Menu {
            flex: 0 0 33.33%; /* Show 3 items at a time */
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            margin-right: 10px; /* Space between items */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center contents horizontally */
            justify-content: center; /* Center contents vertically */
            font-size: larger;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
        }


        .Menu img {
            /* max-width: 300px; */
            width: 300px;
            height: 250px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .arrow-left, .arrow-right {
            position: absolute;
            top: 50%;
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
            transform: translateY(-50%);
        }

        .arrow-left {
            left: 0;
        }

        .arrow-right {
            right: 0;
        }

        .order-summary {
        margin-top: 20px;
        border: 1px solid #ccc;
        padding: 10px;
        width: 300px;
        background-color: beige;
        font-family: 'Times New Roman', Times, serif;
        font-size: medium;
        text-align: center;
        width: 400px;
        height: fit-content;
        padding: 10px;
        align-items: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 500px;  /* Set smaller width */
        height: fit-content; /* Set smaller height */
        margin: 80px auto; /* Centering the container horizontally */
        flex-direction: column;
        border-radius: 20px;
        font-size: 30px;
        
    }

    .order-summary ul {
    /* list-style-type: none; Remove default bullet points */
    padding: 0; /* Remove default padding */

}


    /* .add-to-order {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        padding-top: 1opx;
        padding-bottom: 10px;
        margin-top: 40px;
        margin-bottom: 20px;
        /* font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; *
        font-size: medium;
    } */

    
    .add-to-order {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: medium;
        }

    .add-to-order:hover {
        background-color: #45a049;
    }

    .order-summary li {
    margin-bottom: 10px; /* Space between each list item */
    display: flex; /* Use flexbox to align items */
    justify-content: space-between; /* Space between the text and button */
    align-items: center; /* Center align items vertically */
    margin-bottom: 10px; /* Space between each list item */
    font-family: 'Agency FB', sans-serif;
    font-size: 22px;
}

.remove-button {
    background-color: #ff6666; /* Light red background */
    color: white; /* White text */
    border: none; /* No border */
    padding: 5px 10px; /* Padding around the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    flex-shrink: 0; /* Prevent the button from shrinking */
    margin-left: 10px; /* Add margin to create space on the left */
}

.remove-button:hover {
    background-color: #ff4c4c;  /* Darker red on hover */
}

.Sunday
{
  /* display: flex; */
  flex-direction: column;
  /* background-color: #333; */
  display: flexbox;
  flex-direction: column;
}

.add-to-order-container {
    text-align: center;
    margin-top: 15px;
}

#bulkOrderContainer {
    margin-top: 50px; /* Adjust the space above the bulk order options */
    padding: 10px; /* Add padding */
    border: 1px solid #ddd; /* Light border */
    border-radius: 5px; /* Rounded corners */
    background-color: #f9f9f9; /* Light background */
    width: auto;
    font-size: 20px;
}

        label {
            display: block; /* Block display for labels */
            margin: 5px 0; /* Space above and below */
        }

        input[type="number"] {
            padding: 5px; /* Padding for the number input */
            width: 70px; /* Set a width for the input */
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px; /* Rounded corners */
            font-size: medium;
        }



    </style>
</head>
<body>

<div class="heading">
  EXPERIENCE THE REAL TASTE

</div>

<div class="upperp"> 
    <div class="textp">
      
        <h2>Here are some specially curated meal plans from our expert service</h2>
        <i>According to our experts:</i> <br>
        <ul>
        <li>High-potassium foods: Include bananas, oranges, and sweet potatoes to help balance sodium levels.</li><br>
        <li>Low-sodium foods: Opt for fresh vegetables, herbs, and spices instead of salt for flavoring.</li><br>
        <li>Healthy fats: Include olive oil, nuts, and seeds, which are good for heart health.</li><br>
        <li>Whole grains: Choose brown rice, oats, and quinoa for fiber and stable blood pressure levels.</li><br>
        <li>Sugar and refined carbs: Avoid sugary drinks, candies, and white bread.</li>
        </ul>

        
        <!-- <i>         Here is reference to the article: <a href="https://www.ncbi.nlm.nih.gov/books/NBK279012/">Click Here to know more</a></i> -->
    </div>
    <!-- <img src="https://www.jagannathskitchen.in/images/placeholder.jpg" alt=""> -->
  </div> 


  <div class="variety">
  <!-- <div class="varitimg1"><img src="mpi11.jpeg" alt=""></div> -->
  <div class="varitimg2"><img src="mpi12.jpeg" alt=""></div>
  <div class="varitext">
    <!-- We also offer wide variety of Indian food from Street Food to Multispeacial variety <br>
    Explore More with us in our Variety of dishes so you never miss home cooked food <br>
    Your Health our Priority <br>
    Explore Our Wide Variety of Menu <br>
    To know What you diet consist of follow us below <br> -->
    YOUR HEALTH <br>
    OUR PRIORITY 
  </div>
  
  </div>

  <div id="chart-container">
    <h1>Nutrition Pie Chart</h1>
    <canvas id="myPieChart"></canvas>
    </div>
    <script>
        const bpCtx = document.getElementById('myPieChart').getContext('2d');
        new Chart(bpCtx, {
            type: 'pie',
            data: {
                labels: ['Proteins', 'Carbs', 'Fats'],
                datasets: [{
                    data: [25, 50, 25], // Sample values for BP patients
                    backgroundColor: ['#FF9999', '#99CCFF', '#FFCC99'],
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Diet for BP Patients'
                    }
                }
            }
        });
    </script>

<div class="menuhead">
  SIMPLE<img src="mpi13.jpeg" alt="" class="inline-img">AND <br> TASTY MENU
</div>

   

    

<div class="items">
     
  <div class="menu-container">
    <button class="arrow-left" onclick="scrollMenu(-1)">←</button>
    <div id="menuWrapper" class="menu-wrapper">
            <div class="Menu">
        <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
        <p>
        <ul>
        <li>Vegetable: Steamed Broccoli</li>
        <li>Curry: Lentil Curry (Moong Dal)</li>
        <li>Bread: Bajra Roti</li>
        <li>Dairy: Curd</li>
        <li>Fruit: Apple</li>
        <!-- <li>Fats: 10g, Carbs: 48g, Proteins: 16g</li> -->
        </ul>
        </p>
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                10g
              </div>
              <div class="nutrition-value-label">Fat</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #e79797;">
                48g
              </div>
              <div class="nutrition-value-label">Carb</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                16g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
          </div>
          <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Monday Meal" data-price="150">Add to Order - Rs 350</button>
        </div>
    </div>

    <div class="Menu">
        <img src="mpi10.jpeg"  alt="img">
        <p>  
            <h3><I>TUESDAY</I></h3>
            <ul>
            <li>Vegetable: Spinach Stir Fry</li>
            <li>Curry: Black-Eyed Beans Curry</li>
            <li>Bread: Whole Wheat Chapati</li>
            <li>Dairy: Buttermilk</li>
            <li>Fruit: Orange</li>
            <!-- <li>Fats: 8g, Carbs: 50g, Proteins: 18g</li> -->
            </ul>
        </p>
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                8g
              </div>
              <div class="nutrition-value-label">Fat</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #e79797;">
                50g
              </div>
              <div class="nutrition-value-label">Carb</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                18g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
          </div>
        
          <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Tuesday Meal" data-price="200">Add to Order - Rs 350</button>
        </div>

    </div>

    <div class="Menu">
      <img src="mpi3.jpg"  alt="img">
      <p>  
          <h3><I>WEDNSDAY</I></h3>
          <ul>
          <ul>
            <li>Vegetable: Stir-Fried Bell Peppers</li>
            <li>Curry: Paneer and Peas</li>
            <li>Bread: Jowar Roti</li>
            <li>Non-Veg: Grilled Chicken (optional)</li>
            <li>Dairy: Curd</li>
            <li>Fruit: Papaya</li>
            <!-- <li>Fats: 14g, Carbs: 47g, Proteins: 28g</li> -->
            </ul>
                </p>
      <div class="nutrition-values">
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
              14g
            </div>
            <div class="nutrition-value-label">Fat</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #e79797;">
              47g
            </div>
            <div class="nutrition-value-label">Carb</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
              28g
            </div>
            <div class="nutrition-value-label">Protein</div>
          </div>
        </div>


        <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Wednesday Meal" data-price="150">Add to Order - Rs 350</button>
        </div>

      </div>

  <div class="Menu">
    <img src="mpi6.jpg"  alt="img">
    <p>  
        <h3><I>THURSDAY</I></h3>
        <ul>
        <li>Vegetable: Steamed Carrot and Beans</li>
        <li>Curry: Chickpea Curry</li>
        <li>Bread: Ragi Roti</li>
        <li>Dairy: Buttermilk</li>
        <li>Fruit: Guava</li>
        <!-- <li>Fats: 9g, Carbs: 52g, Proteins: 20g</li> -->
        </ul>
            </p>
    <div class="nutrition-values">
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
            9g
          </div>
          <div class="nutrition-value-label">Fat</div>
        </div>
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #e79797;">
            52g
          </div>
          <div class="nutrition-value-label">Carb</div>
        </div>
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
            20g
          </div>
          <div class="nutrition-value-label">Protein</div>
        </div>
      </div>

      <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Thursday Meal" data-price="250">Add to Order - Rs 350</button>
        </div>

  </div>

    <div class="Menu">
      <img src="mpi5.jpg"  alt="img">
      <p>  
          <h3><I>FRIDAY</I></h3>
          <ul>
            <li>Vegetable: Mixed Vegetables (Cabbage, Carrot, Peas)</li>
            <li>Curry: Red Lentil (Masoor Dal)</li>
            <li>Bread: Whole Wheat Chapati</li>
            <li>Dairy: Curd</li>
            <li>Fruit: Kiwi</li>
            <!-- <li>Fats: 7g, Carbs: 49g, Proteins: 17g</li> -->
            </ul>
      </p>
      <div class="nutrition-values">
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
              7g
            </div>
            <div class="nutrition-value-label">Fat</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #e79797;">
              49g
            </div>
            <div class="nutrition-value-label">Carb</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
              17g
            </div>
            <div class="nutrition-value-label">Protein</div>
          </div>
        </div>


        <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Friday Meal" data-price="150">Add to Order - Rs 350</button>
        </div>

    </div>

        <div class="Menu">
          <img src="mpi8.jpg"  alt="img">
          <p>  
              <h3><I>SATURDAY</I></h3>
              <ul>
                <li>Vegetable: Bottle Gourd (Lauki)</li>
                <li>Curry: Black Bean Curry</li>
                <li>Bread: Jowar Roti</li>
                <li>Dairy: Buttermilk</li>
                <li>Fruit: Banana</li>
                <!-- <li>Fats: 11g, Carbs: 54g, Proteins: 19g</li> -->
                </ul>
          </p>
          <div class="nutrition-values">
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                  11g
                </div>
                <div class="nutrition-value-label">Fat</div>
              </div>
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #e79797;">
                  54g
                </div>
                <div class="nutrition-value-label">Carb</div>
              </div>
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                  19g
                </div>
                <div class="nutrition-value-label">Protein</div>
              </div>
            </div>

            <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Saturday Meal" data-price="200">Add to Order - Rs 350</button>
        </div> 


        </div>

      <div class="Menu">
        <img src="mpi7.jpg"  alt="img">
        <p>  
            <h3><I>SUNDAY</I></h3>
            <ul>
            <li>Vegetable: Okra (Bhindi) Stir Fry</li>
            <li>Curry: Egg Curry</li>
            <li>Bread: Whole Wheat Chapati</li>
            <li>Non-Veg: Grilled Fish (optional)</li>
            <li>Dairy: Curd</li>
            <li>Fruit: Berries (Mixed)</li>
            <!-- <li>Fats: 15g, Carbs: 46g, Proteins: 26g</li> -->
            </ul>
        </p>
        <div class="Sunday">
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                15g
              </div>
              <div class="nutrition-value-label">Fat</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #e79797;">
                46g
              </div>
              <div class="nutrition-value-label">Carb</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                26g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
             </div>
             <div class="add-to-order-container">
            <label>
                <input type="checkbox" class="bulkOrderCheckbox"> Bulk Order
            </label>
            <div class="bulkOrderContainer" style="display: none;">
                <label>Number of Meals:</label>
                <input type="number" class="numMeals" min="1" value="1">
            </div>
            <button class="add-to-order" data-name="Sunday Meal" data-price="350">Add to Order - Rs 350</button>
        </div>
      </div>
        
    </div>
  </div>
  <button class="arrow-right" onclick="scrollMenu(1)">→</button>
</div>
</div>



<script>
  const itemsToShow = 3; // Number of items to show at a time
  let currentIndex = 0;

  function scrollMenu(direction) {
      const menuWrapper = document.getElementById('menuWrapper');
      const itemWidth = menuWrapper.querySelector('.Menu').offsetWidth + 10; // Width of each item + margin
      const totalItems = menuWrapper.children.length;
      const totalWidth = itemWidth * totalItems;
      const visibleWidth = menuWrapper.clientWidth;
      
      // Calculate the new position
      currentIndex += direction;

      // Looping logic
      if (currentIndex < 0) {
          currentIndex = totalItems - itemsToShow; // Go to the end
      } else if (currentIndex > totalItems - itemsToShow) {
          currentIndex = 0; // Go to the start
      }

      menuWrapper.style.transform = `translateX(-${itemWidth * currentIndex}px)`;
  }
</script>

<div class="order-summary">
    <h3>Order Summary</h3>
    <ul id="summaryList"></ul>
    <div>Total Amount: <span id="totalAmount"> Rs 0 </span></div>
</div>

<script>
    // Add event listeners to all bulk order checkboxes
    document.querySelectorAll('.bulkOrderCheckbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const bulkOrderContainer = this.closest('.add-to-order-container').querySelector('.bulkOrderContainer');
            // Show or hide the corresponding bulk order input based on checkbox state
            bulkOrderContainer.style.display = this.checked ? 'block' : 'none';
        });
    });

    // Add event listeners to all "Add to Order" buttons
    document.querySelectorAll('.add-to-order').forEach(button => {
        button.addEventListener('click', function() {
            const mealName = this.dataset.name;
            const mealPrice = parseInt(this.dataset.price);
            const bulkOrderCheckbox = this.closest('.add-to-order-container').querySelector('.bulkOrderCheckbox');
            const quantityInput = this.closest('.add-to-order-container').querySelector('.numMeals');
            const quantity = bulkOrderCheckbox.checked ? parseInt(quantityInput.value) : 1;
            const totalPrice = mealPrice * quantity;

            // Add to order summary
            const summaryList = document.getElementById('summaryList');
            const summaryItem = document.createElement('li');
            summaryItem.innerHTML = `${mealName} x ${quantity}: Rs ${totalPrice} <button class="remove-button">Remove</button>`;
            summaryList.appendChild(summaryItem);

            // Add event listener for remove button
            summaryItem.querySelector('.remove-button').addEventListener('click', function() {
                summaryList.removeChild(summaryItem);
                // Update total amount
                const totalAmountElement = document.getElementById('totalAmount');
                const currentTotal = parseInt(totalAmountElement.textContent.replace('Rs ', ''));
                totalAmountElement.textContent = `Rs ${currentTotal - totalPrice}`;
            });

            // Update the total amount
            const totalAmountElement = document.getElementById('totalAmount');
            const currentTotal = parseInt(totalAmountElement.textContent.replace('Rs ', ''));
            totalAmountElement.textContent = `Rs ${currentTotal + totalPrice}`;
        });
    });
</script>

</body>
</html>
