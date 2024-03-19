<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
     integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="/">Personal Media Library</a></h1>

			<ul class="nav">
                
                <li class="books">
                    <a href="catalog.php?cat=books">
                        <i class="fa-solid fa-book">

                        </i>    Have Read</a></li>

                <li class="movies">
                    <a href="catalog.php?cat=movies">
                        <i class="fa-solid fa-bookmark">
                     </i>   Want To Read</a></li>

                <li class="music">
                    <a href="catalog.php?cat=music">
                        <i class="fa-solid fa-star">
                    </i>    Favourites</a></li>

                <li class="muzic">
                    <a href="catalog.php?cat=music">
                        <i class="fa-solid fa-book-open-reader">
                        </i>    Current Read</a></li>

                <li class="suggest">
                    <a href="suggest.php">
                        <i class="fa-solid fa-magnifying-glass">
                        </i>    Search Book</a></li>
            </ul>

		</div>

	</div>

	<div id="content">