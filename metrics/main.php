<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>
<body>
<main role="main" class="container">

  <div>
    <h1>Hello, world!</h1>

    <a href="/createIndex">Create elasticsearch index</a><br>
    <a href="/pushMetric">Generate random metric and send it to elasticsearch</a>
  </div>
  <div>
    <hr>
    <a href="/">PHP Metrics generator (self)</a> <br>
    <a href="http://localhost:8081/">PHP Prometheus exporter</a> <br>
    <a href="http://localhost:3000/">Grafana (admin:foobar)</a> <br>
    <a href="http://localhost:5601/">Kibana</a> <br>
    <a href="http://localhost:9090/">Prometheus</a> <br>
    <a href="http://localhost:9100/">Node-exporter</a> <br>
    <a href="http://localhost:8082/">cAdvisor</a><br>
    <a href="http://localhost:9200/">Elasticsearch</a><br>
  </div>

  <div>
    <hr>
    <h2>Links</h2>
    <a href="https://github.com/vegasbrianc/prometheus">https://github.com/vegasbrianc/prometheus</a> <br>
    <a href="http://localhost:9090/api/v1/label/__name__/values">http://localhost:9090/api/v1/label/__name__/values</a>
  </div>

</main><!-- /.container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
