<p <?php echo get_block_wrapper_attributes(); ?>>

<script>
  function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
</script>
<div id="staff-block-vanilla" style="overflow: hidden;">
  <script>
  const staff = JSON.parse( httpGet('http://dev.local/wp-json/wp/v2/br_person') );
  let theCode = '';
  staff.forEach(element => theCode += createRow(element));
  staff.forEach(element => console.log(element));

  var block = document.getElementById('staff-block-vanilla');
  block.innerHTML = theCode;
  // console.log(theCode);


function createRow(item) {
  let thePermalink = item.link;
  let theName = item.cmb2.custom_fields.br_name;
  let theBio = item.cmb2.custom_fields.br_bio;
  let thePortrait = item.cmb2.custom_fields.br_portrait;
  let theTitle = item.cmb2.custom_fields.br_title;

  let theRow = `<div class="staff-member-div" style="float:left; width: 100%">
							<a href="` + thePermalink + `">
								<div class="span4" style="float: left; padding-top: 10px;  width: 33%;  text-align: center;">
									<img class="staff-portrait" src="` + thePortrait + `" style="width: 124px; margin: 0px auto" />
									<br />
									<p class="title-text" style="padding: 0px 0px 0px 0px!important; text-align: center;">` + theTitle + `</p>
								</div>
							</a>

				<div class="span8">
						<div class="name-text"><b>` + theName + `</b></div>
						<div class="bio-text">` + theBio + `</div>
				</div>

				</div>`;

  return theRow;
}
</script>
</div>
</p>
