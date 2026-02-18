<?php
// get data for data for databases
$result = getCourses();
// 
renderView('courses',['title' => 'Courses Information',
'result' => $result
]);