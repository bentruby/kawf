<?php

$user->req("ForumAdmin");

page_header("Forum User ACL");

if (isset($message))
  page_show_message($message);

$result = sql_query("select * from f_moderators");
?>

<a href="useracladd.phtml">Add new user ACL</a>

<p>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td bgcolor="#99999" width="600">
<table width="100%" cellpadding="3" cellspacing="1" border="0">

<tr bgcolor="#D0D0D0">
<td>aid</td>
<td>Screen Name</td>
<td>Forums</td>
<td>Capabilities</td>
</tr>

<?php
$useracls = Array();
$useraclhash = Array();

while ($useracl = sql_fetch_array($result)) {
  if (!isset($useraclhash[$useracl['aid']])) {
    $useracl['fid'] = Array($useracl['fid']);
    $useracls[] = $useracl;
    $useraclhash[$useracl['aid']] = $useracl;
  } else {
    $useraclhash[$useracl['aid']]['fid'][] = $useracl['fid'];
  }
}

foreach ($useracls as $useracl) {
  $bgcolor = ($count % 2) ? "#F7F7F7" : "#ECECFF";
  echo "<tr bgcolor=\"$bgcolor\">\n";
  echo "<td><a href=\"useraclmodify.phtml?aid=" . $useracl['aid'] . "\">" . $useracl['aid'] . "</a></td>\n";
  echo "<td>" . $useracl['name'] . "</td>\n";
  echo "<td>" . $useracl['capabilities'] . "</td>\n";
  echo "</tr>\n";

  $count++;
}
?>

</table></td></tr>
</table>

<?php
page_footer();
?>
