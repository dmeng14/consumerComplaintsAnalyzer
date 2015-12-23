 <?php
	//import config.php
	
 	$html =<<< EOF
	<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Analyser</title>
<link rel="stylesheet" href="styles.css" type="text/css" />

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
</head>

<body>

		<section id="body" class="width">
			<aside id="sidebar" class="column-left">

			<header>
				<h1><a href="index.php">Analyser</a></h1>

				<h2>for consumer complaints analysis!</h2>
				
			</header>

			<nav id="mainnav">
  				<ul>
                            
							<li class="selected-item"><a href="index.php">Home</a></li>
							
							<li class="category-item"><a>Financial Products</a></li>
							<li><a href="debtCollection.php">Debt collection</a></li>
							<li><a href="creditReporting.php">Credit reporting</a></li>
							<li><a href="consumerLoan.php">Consumer loan</a></li>
							<li><a href="moneyTransfer.php">Money transfers</a></li>
							
							<li class="category-item"><a>Financial Companies</a></li>
							<li><a href="chase.php">Chase</a></li>
							<li><a href="boa.php">Bank of America</a></li>
							<li><a href="wf.php">Wells Fargo</a></li>
							
													
          </ul>
			</nav>

			
			
			</aside>
			<section id="content" class="column-right">
                		
	    <article>
				
			
			<h2>Introduction to consumer complaints analyser</h2>
			<div class="article-info"> </div>

            <p style="text-indent: 3em;"> 
						Each week, thousands of consumer complaints about financial products and 
						services are submitted to the Consumer Financial Protection Bureau (CFPB) consumer 
						complaints database, which are then sent to the companies for response. Up to now 
						the database stores over 460,000 consumer complaints. These data provides valuable 
						information for analysts, researchers and financial institutions to analyze reasons 
						behinds the complaints, the emerging trends, how the companies resolve complaints, 
						the financial services providers, and market activities, etc. Therefore, the consumer 
						complaints dataset is one of the top viewed datasets on data.gov. 
						</p>

						<p style="text-indent: 3em;">
						Here, we are summarizing the number of complaints related to the issues of the financial
						products and services so far submitted to CFPB. The financial products includes:
						</p>	

            <ul class="styledlist">
                <li>Debt collection</li>
                <li>Credit reporting</li>
                <li>Consumer loan</li>
								<li>Money transfers</li>
                <li>Mortgage</li>
								<li>Bank account or service</li>
								<li>Credit card</li>
								<li>Student loan</li>
								<li>Payday loan</li>
								<li>Prepaid card</li>
            </ul>
						<p style="text-indent: 3em;">
						The available financial products from the main financial companies are also summarised on the website
						for the convenience of consumers to compare. The financial companies compared includes:
						</p>		
            <ul class="styledlist">
                <li>Chase</li>
                <li>Bank of America</li>
                <li>Wells Fargo</li>
            </ul>						
						
		
		</article>
		
			<footer class="clear">
				<p>&copy; CSCI1000 Database System Course Project by Dan Meng, Weijia Sun, Yao Jin, Rui Sun.
				<a href="http://zypopwebtemplates.com/">Free CSS Templates</a> by ZyPOP</p>
			</footer>

		</section>

		<div class="clear"></div>

	</section>
	

</body>
</html>
EOF;
echo $html;

?>