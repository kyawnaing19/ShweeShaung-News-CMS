<?php
// Your paragraph from the database
$paragraph = "CNN — Dozens of people, including children, have been 
killed as “extremely intense” Israeli airstrikes and shelling pounded multiple locations in
 Rafah overnight Monday, according to the Palestine Red Crescent Society, as international alarm
  mounts over Israel’s planned ground offensive in the southern Gazan city. More than 100 people were killed due to Israeli airstrikes as warplanes targeted different areas of the city and helicopters fired machine guns along the border areas, the PRCS said early Monday. CNN cannot independently verify the number of casualties on the ground. There are fears the death toll could rise further as the PRCS said people remain trapped under the rubble and there is still a heavy presence \n of warplanes in the skies over Rafah. The director of Abu Yousef Al-Najjar Hospital said medical facilities in Rafah “cannot handle the large number of injuries due to the Israeli occupation’s bombardment.” Footage obtained by CNN showed a chaotic scene inside Rafah’s Al Kuwaiti hospital, with medics trying to resuscitate a motionless child in one scene and another showing doctors treating a wounded man on the hospital floor. In another video a woman was inconsolable as she held a child’s body wrapped in white cloth.";

// Split the paragraph into lines
$lines = preg_split('/\n/', $paragraph);

// Display lines in groups of three
foreach (array_chunk($lines, 3) as $group) {
    echo '<div class="paragraph-group">';
    foreach ($group as $line) {
        echo '<p>' . $line . '</p>';
    }
    echo '</div>';
}
?>
