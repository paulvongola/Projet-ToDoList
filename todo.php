<?php
require_once 'BDD.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2>Todo List : Encore plus efficace qu'un agenda !</h2>
	</div>
	<form method="post" action="" class="input_form">
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

    <table>
	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
        $sql = "SELECT * FROM tasks";
        $stmt = $db->prepare($sql);
        $stmt->execute();
$tasks = $stmt->fetchAll();

		foreach ($tasks as $key => $task) { ?>
            			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $task['name']; ?> </td>
				<td class="delete"> 
					<a href="todo.php?del_task=<?php echo $task['id'] ?>">x</a> 
				</td>
			</tr>

       <?php }            ?>
	</tbody>
</table>

    <?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>
<?php
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

}

?>



</body>
</html>
<?php
    // initialize errors variable
	$errors = "";

	// connexion à la BDD
	session_start();


	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (name) VALUES (?)";
			$stmt = $db->prepare($sql);
            $stmt->execute([$task]);
			header('location: todo.php');
		}
	}	




    ?>