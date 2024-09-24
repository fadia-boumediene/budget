<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
  body {
  background-color: #f8f9fa;
}

.family-tree {
  text-align: center;
}
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

.member {
  display: inline-block;
  padding: 5px;
  cursor: pointer;
  background: #fff;
  border: 1px solid #dee2e6;
  border-radius: 4px;
}

.member:hover {
  background-color: #e9ecef;
}
    </style>
</head>
<body>
<div class="container family-tree">
    <div class="row justify-content-center">
      <div class="col-12 tree">
        <ul>
          <li>
            <span class="member">Grandparent</span>
            <ul>
              <li>
                <span class="member">Parent 1</span>
                <ul>
                  <li><span class="member">Child 1</span></li>
                  <li><span class="member">Child 2</span></li>
                </ul>
              </li>
              <li>
                <span class="member">Parent 2</span>
                <ul>
                  <li><span class="member">Child 3</span></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>
<script>
 document.querySelectorAll('.member').forEach(member => {
  member.addEventListener('click', function() {
    const children = member.nextElementSibling;
    if (children) {
      if (children.style.display === 'flex') {
        children.style.display = 'none';
      } else {
        children.style.display = 'flex';
      }
    }
  });
});
</script>
</html>