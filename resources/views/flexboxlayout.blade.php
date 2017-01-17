<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>

	header , footer{
		background-color: indianred;
		padding: 5px;
		margin: 5px;
		display: block;
		min-height: 100px;
		border: 1px solid #eebb55;
		border-radius: 7pt;
		text-align: center;
	}

	article{
		flex: 200px;
	}

	section{
		display: flex;
	}

	.flex-colum{
		display: flex;
		flex-direction: column;
	}
	.flex-row{

	}

	nav{
		margin: 4px;
		padding: 5px;
		border: 1px solid #8888bb;
		border-radius: 7pt;
		background: #ccccff;
		-webkit-flex: 1 6 20%;
		flex: 1 6 20%;
		-webkit-order: 1;
		order: 1;
	}



</style>
<body>

	<header>
		<h1>Semple Flexbox example</h1>
	</header>

	<nav>
		<ul>
			<li>Link1</li>
			<li>Link2</li>
			<li>Link3</li>
			<li>Link4</li>
			<li>Link5</li>

		</ul>
	</nav>

	<section class="flex-colum">

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</article>

		<article>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</article>
	</section>



	<footer>
		Footer
	</footer>

</body>
</html>