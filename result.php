<?php
    require_once './core/autoLoadClass.php';
    require_once './Database/dbHelper.php';
    $questionID = base_convert($_GET["result"],36,10);
    $dbHelp = new dbHelp;
    $userAnswersAndCount = $dbHelp->select("answer,votes","Answers",array("questionID"=>$questionID));
    $question = $dbHelp->select("question","Question",array("questionID"=>$questionID));
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="vendor/components/jquery/jquery.js"></script>
    <script type="text/javascript">


      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          <?php
          $sum = 0;
            foreach ($userAnswersAndCount as $key => $value) {
              $sum += $value['votes'];
              echo "['".$value["answer"]."',".$value['votes']."],";
            }
          if($sum == 0)
            echo "['No Votes Yet',1]";
          ?>
        ]);

        // Set chart options
        var options = { 'title':<?php echo "'".$question[0]["question"]."'" ?>,
                        'width':900,
                        'height':700,
                        'is3D':true,
                        sliceVisibilityThreshold:0
                      };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
  <center>
    <!--Div that will hold the pie chart-->
    <div id="chart_div" style="margin-left:16%"></div>
    </center>
  </body>
</html>