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

        #chart-container {
            text-align: center;
            width: fit-content;  /* Set smaller width */
            height: fit-content; /* Set smaller height */
            margin: 20px auto; /* Centering the chart on the page */
            padding-bottom: 50px;
            margin-bottom: 100px;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.712);
            font-weight: 300;
            color: black;
            
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
          background-color: antiquewhite;
            border-radius: 20px;
            height: auto;
            width: auto;
            padding: 10px;
            margin-bottom: 10px;
            justify-content: center;
        }

        .upperp img{
         
          
          width: 250px;
          height: 250px;
          padding: 20px;
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
background-image: url('vegetables.jpeg');
       background-size: cover; 
       background-position: center; 
       background-repeat: no-repeat;
       
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
            margin: auto;
            overflow: hidden;
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
        }

        .Menu img {
            max-width: 300px;
            height: auto;
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
    </style>
</head>
<body>

<div class="upperp"> 
    <div class="textp">
      
        <h2>Here are some specially curated meal plans from our expert service</h2>
        <i>According to our experts:</i> <br>
        <ul>
            <li>High-fiber foods: Whole grains, legumes, and vegetables help slow the absorption of sugar.</li>
            <li>Fats: Include sources like avocados, olive oil, and nuts, which can improve insulin sensitivity.</li>
            <li>Lean proteins: Opt for chicken, fish, tofu, and legumes for sustained energy.</li>
            <li>Sugar and refined carbs: Avoid sugary drinks, candies, and white bread.</li>
        </ul>
        <i>Here is reference to the article: <a href="https://www.ncbi.nlm.nih.gov/books/NBK279012/">Click Here to know more</a></i>
    </div>
    <img src="https://www.jagannathskitchen.in/images/placeholder.jpg" alt="">
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


   

    

<div class="items">
     
  <div class="menu-container">
    <button class="arrow-left" onclick="scrollMenu(-1)">←</button>
    <div id="menuWrapper" class="menu-wrapper">
            <div class="Menu">
        <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
        <p>
            <h3><I>MONDAY</I></h3>
            <ul>
            <li>Vegetables:Palak</li>
            <li>Moong Dal Khichdi with sautéed spinach</li>
            <li>Jowar Bhakri</li>
            <li>Curd</li>
            <li>Seasonal Fruits</li>
        </ul>
        </p>
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                12g
              </div>
              <div class="nutrition-value-label">Fat</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #e79797;">
                90g
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
    </div>

    <div class="Menu">
        <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
        <p>  
            <h3><I>TUESDAY</I></h3>
            <ul>
            <li>Vegetables:Methi</li>
            <li>Dal Tadka (Yellow Lentils)</li>
            <li>Brown rice</li>
            <li>Multigrain Chapati</li>
            <li>Curd</li>
            <li>Seasonal Fruits</li>
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
                100g
              </div>
              <div class="nutrition-value-label">Carb</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                22g
              </div>
              <div class="nutrition-value-label">Protein</div>
            </div>
          </div>
        
    </div>

    <div class="Menu">
      <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
      <p>  
          <h3><I>WEDNSDAY</I></h3>
          <ul>
          <li>Vegetable Besan Chilla</li>
          <li>Mixed Vegetable Curry</li>
          <li>Brown rice</li>
          <li>Multigrain Chapati</li>
          <li>Curd</li>
          <li>Seasonal Fruits</li>
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
              110g
            </div>
            <div class="nutrition-value-label">Carb</div>
          </div>
          <div class="nutrition-value">
            <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
              25g
            </div>
            <div class="nutrition-value-label">Protein</div>
          </div>
        </div>
      
  </div>

  <div class="Menu">
    <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
    <p>  
        <h3><I>THURSDAY</I></h3>
        <ul>
        <li>Palak Dal (Spinach and Lentil Curry) with Quinoa</li>
        <li>Palak Paneer</li>
        <li>Brown rice</li>
        <li>Multigrain Chapati</li>
        <li>Curd</li>
        <li>Seasonal Fruits</li>
    </ul>
    </p>
    <div class="nutrition-values">
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
            20g
          </div>
          <div class="nutrition-value-label">Fat</div>
        </div>
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #e79797;">
            110g
          </div>
          <div class="nutrition-value-label">Carb</div>
        </div>
        <div class="nutrition-value">
          <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
            30g
          </div>
          <div class="nutrition-value-label">Protein</div>
        </div>
      </div>
    </div>

    <div class="Menu">
      <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
      <p>  
          <h3><I>FRIDAY</I></h3>
          <ul>
          <li>Methi Thepla (Fenugreek Flatbread)</li>
          <li>Masala Brown rice</li>
          <li>Multigrain Chapati</li>
          <li>Curd</li>
          <li>Seasonal Fruits</li>
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
              105g
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
        </div>

        <div class="Menu">
          <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
          <p>  
              <h3><I>SATURDAY</I></h3>
              <ul>
              <li>Vegetables:Chole (Chickpea Curry)</li>
              <li> Methi Dal (Fenugreek and Lentil Curry)</li>
              <li>Brown rice</li>
              <li>Multigrain Chapati</li>
              <li>Curd</li>
              <li>Seasonal Fruits</li>
          </ul>
          </p>
          <div class="nutrition-values">
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                  12g
                </div>
                <div class="nutrition-value-label">Fat</div>
              </div>
              <div class="nutrition-value">
                <div class="nutrition-value-circle" style="background-color: #e79797;">
                  110g
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
          
      </div>

      <div class="Menu">
        <img src="https://i.pinimg.com/736x/29/d3/f3/29d3f3f2b086e58d99ee45139d21fe0b.jpg"  alt="img">
        <p>  
            <h3><I>SUNDAY</I></h3>
            <ul>
            <li>Tandoori Paneer Tikka</li>
            <li>Quinoa Vegetable Biryani</li>
            <li>Raita: Cucumber Mint Raita</li>
            <li>Dessert: Sugar-Free Phirni (Rice Pudding)</li>
            <li>Seasonal Fruits</li>
        </ul>
        </p>
        <div class="nutrition-values">
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #c1e3f7;">
                18g
              </div>
              <div class="nutrition-value-label">Fat</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #e79797;">
                100g
              </div>
              <div class="nutrition-value-label">Carb</div>
            </div>
            <div class="nutrition-value">
              <div class="nutrition-value-circle" style="background-color: #b1e3b1;">
                35g
              </div>
              <div class="nutrition-value-label">Protein</div>
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
</body>
</html>
