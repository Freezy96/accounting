<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php include 'header.php'; ?>
<form method="POST" action="login.php" name="form1">

 <td>
          Amount:<input type="number" step="0.01" name="<?php echo "amount".$account_number_count; ?>"><br>
</td>
<tr>
<p class="text-right"><button class="btn btn-lg btn-primary" type="submit"><span class="glyphicon glyphicon-log-in"></span>&nbsp;登录</button></p>
					</form>
<tr>
<?php include('footer.php'); ?>

</body>
</html>	