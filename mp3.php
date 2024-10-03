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

.remove-btn {
    background-color: #ff6666; /* Light red background */
    color: white; /* White text */
    border: none; /* No border */
    padding: 5px 10px; /* Padding around the button */
    cursor: pointer; /* Pointer cursor on hover */
    border-radius: 5px; /* Rounded corners */
    flex-shrink: 0; /* Prevent the button from shrinking */
    margin-left: 10px; /* Add margin to create space on the left */
}

.remove-btn:hover {
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
        <li>Low-potassium vegetables: Opt for cabbage, cauliflower, and bell peppers to reduce potassium intake.</li><br>
        <li>Low-phosphorus foods: Choose white bread, rice, and corn instead of whole grains.</li><br>
        <li>Healthy fats: Include olive oil and unsalted butter in moderation to maintain balanced nutrition.</li><br>
        <li>Lean proteins (limited): Include egg whites, chicken, and small portions of legumes to avoid straining the kidneys.</li><br>
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
    <div id="error-message">Error fetching data. Please try again later.</div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch data using AJAX
            fetch('?action=getData')
                .then(response => {
                    if (response.ok) {
                        return response.json(); // Parse JSON
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.error);
                    }
                    
                    // Extract data for pie chart
                    const protien = parseFloat(data.Protiens);
                    const fat = parseFloat(data.Fats);
                    const carbs = parseFloat(data.Carbs);

                    // Create pie chart
                    const ctx = document.getElementById('myPieChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Proteins', 'Fats', 'Carbs'],
                            datasets: [{
                                data: [protien, fat, carbs],
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            },
                            layout: {
                                padding: 20 // Add padding around the chart
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('error-message').style.display = 'block';
                });
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
        <li>Vegetable: Cauliflower Stir Fry</li>
        <li>Curry: Mung Bean Dal (limited salt)</li>
        <li>Bread: White Chapati</li>
        <li>Dairy: Curd (in moderation)</li>
        <li>Fruit: Apple (peeled)</li>
        <!-- Fats: 8g, Carbs: 50g, Proteins: 15g -->
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
                15g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
          </div>
          <button class="add-to-order" onclick="addToOrder('Monday', 150)">Add to Order - Rs150</button>
    </div>

    <div class="Menu">
        <img src="mpi10.jpeg"  alt="img">
        <p>  
            <h3><I>TUESDAY</I></h3>
            <ul>
            <li>Vegetable: Bell Peppers (Low Sodium Stir Fry)</li>
            <li>Curry: Yellow Moong Dal</li>
            <li>Bread: Rice Flour Roti</li>
            <li>Dairy: Buttermilk (small portion)</li>
            <li>Fruit: Pear (peeled)</li>
            <!-- Fats: 9g, Carbs: 48g, Proteins: 16g -->
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
        
          <button class="add-to-order" onclick="addToOrder('Tuesday', 200)">Add to Order - Rs200</button>

    </div>

    <div class="Menu">
      <img src="mpi3.jpg"  alt="img">
      <p>  
          <h3><I>WEDNSDAY</I></h3>
          <ul>
            <li>Vegetable: Cabbage Stir Fry</li>
            <li>Curry: Split Yellow Moong Dal</li>
            <li>Bread: White Chapati</li>
            <li>Dairy: Curd (small portion)</li>
            <li>Fruit: Watermelon (small portion)</li>
            <!-- Fats: 7g, Carbs: 47g, Proteins: 14g -->
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
              47g
            </div>
            <div class="nutrition-value-label">Carb</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
              14g
            </div>
            <div class="nutrition-value-label">Protein</div>
          </div>
        </div>
        <button class="add-to-order" onclick="addToOrder('Wednesday', 150)">Add to Order - Rs150</button>
    </div>

  <div class="Menu">
    <img src="mpi6.jpg"  alt="img">
    <p>  
        <h3><I>THURSDAY</I></h3>
        <ul>
        <li>Vegetable: Bottle Gourd (Lauki, limited salt)</li>
        <li>Curry: Kidney Beans (small portion)</li>
        <li>Bread: Corn Flour Roti</li>
        <li>Dairy: Buttermilk (in moderation)</li>
        <li>Fruit: Pineapple (small portion)</li>
        <!-- Fats: 10g, Carbs: 50g, Proteins: 15g -->
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
            50g
          </div>
          <div class="nutrition-value-label">Carb</div>
        </div>
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
            15g
          </div>
          <div class="nutrition-value-label">Protein</div>
        </div>
      </div>
      <button class="add-to-order" onclick="addToOrder('Thursday', 250)">Add to Order - Rs250</button>
  </div>

    <div class="Menu">
      <img src="mpi5.jpg"  alt="img">
      <p>  
          <h3><I>FRIDAY</I></h3>
         <ul>
            <li>Vegetable: Green Beans Stir Fry</li>
            <li>Curry: Masoor Dal (red lentils, low sodium)</li>
            <li>Bread: White Chapati</li>
            <li>Dairy: Curd (small portion)</li>
            <li>Fruit: Blueberries</li>
            <!-- Fats: 8g, Carbs: 45g, Proteins: 13g -->
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
              45g
            </div>
            <div class="nutrition-value-label">Carb</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
              13g
            </div>
            <div class="nutrition-value-label">Protein</div>
          </div>
        </div>
        <button class="add-to-order" onclick="addToOrder('Friday', 150)">Add to Order - Rs150</button>
    </div>

        <div class="Menu">
          <img src="mpi8.jpg"  alt="img">
          <p>  
              <h3><I>SATURDAY</I></h3>
              <ul>
                <li>Vegetable: Carrot and Capsicum Stir Fry</li>
                <li>Curry: White Chickpeas (limited salt)</li>
                <li>Bread: Rice Flour Roti</li>
                <li>Dairy: Buttermilk (small portion)</li>
                <li>Fruit: Apple (peeled)</li>
                <!-- Fats: 9g, Carbs: 50g, Proteins: 15g -->
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
                  50g
                </div>
                <div class="nutrition-value-label">Carb</div>
              </div>
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                  15g
                </div>
                <div class="nutrition-value-label">Protein</div>
              </div>
            </div>
            <button class="add-to-order" onclick="addToOrder('Saturday', 200)">Add to Order - Rs200</button>
        </div>

      <div class="Menu">
        <img src="mpi7.jpg"  alt="img">
        <p>  
            <h3><I>SUNDAY</I></h3>
            <ul>
            <li>Vegetable: Zucchini Stir Fry</li>
            <li>Curry: Egg Curry (low sodium)</li>
            <li>Bread: White Chapati</li>
            <li>Dairy: Curd (small portion)</li>
            <li>Fruit: Peach (peeled)</li>
            <!-- Fats: 11g, Carbs: 48g, Proteins: 18g -->
            </ul>
        </p>
        <div class="Sunday">
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                11g
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
                18g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
             </div>
             <div class="add-to-order-container">
                <button class="add-to-order" onclick="addToOrder('Sunday', 350)">Add to Order - Rs 350</button>
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

<div id="orderSummary" class="order-summary">
    <h3>Order Summary</h3>
    <ul id="orderItems"></ul>
    <p>Total: Rs <span id="totalPrice">0</span></p>
</div>

<script>
   let totalPrice = 0;

function addToOrder(day, price) {
    const orderItems = document.getElementById('orderItems');
    const totalPriceElement = document.getElementById('totalPrice');

    // Create a list item for the order summary
    const listItem = document.createElement('li');
    listItem.textContent = `${day} Meal - Rs ${price} `;

    // Create a "Remove" button for each item
    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.classList.add('remove-btn'); // Add the class for CSS styling

    // Add an event listener to the remove button
    removeButton.addEventListener('click', function () {
        // Update the total price by subtracting the price of the removed item
        totalPrice -= price;
        totalPriceElement.textContent = totalPrice;

        // Remove the list item from the order summary
        orderItems.removeChild(listItem);
    });

    // Add the remove button to the list item
    listItem.appendChild(removeButton);

    // Add the list item to the order summary
    orderItems.appendChild(listItem);

    // Update total price
    totalPrice += price;
    totalPriceElement.textContent = totalPrice;
}

</script>

</body>
</html>
