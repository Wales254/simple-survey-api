<?php
// Set content type to XML
header('Content-Type: application/xml');

// Create a SimpleXMLElement object to build the XML response
$xml = new SimpleXMLElement('<questions/>');

// Add question 1
$question1 = $xml->addChild('question');
$question1->addChild('name', 'full_name');
$question1->addChild('type', 'short_text');
$question1->addChild('required', 'yes');
$question1->addChild('text', 'What is your full name?');
$question1->addChild('description', '[Surname] [First Name] [Other Names]');

// Add question 2
$question2 = $xml->addChild('question');
$question2->addChild('name', 'email_address');
$question2->addChild('type', 'email');
$question2->addChild('required', 'yes');
$question2->addChild('text', 'What is your email address?');

// Add question 3
$question3 = $xml->addChild('question');
$question3->addChild('name', 'description');
$question3->addChild('type', 'long_text');
$question3->addChild('required', 'yes');
$question3->addChild('text', 'Tell us a bit more about yourself');

// Add question 4
$question4 = $xml->addChild('question');
$question4->addChild('name', 'gender');
$question4->addChild('type', 'choice');
$question4->addChild('required', 'yes');
$question4->addChild('text', 'What is your gender?');
$gender_options = $question4->addChild('options');
$gender_options->addChild('option', 'MALE');
$gender_options->addChild('option', 'FEMALE');
$gender_options->addChild('option', 'OTHER');

// Add question 5
$question5 = $xml->addChild('question');
$question5->addChild('name', 'programming_stack');
$question5->addChild('type', 'choice');
$question5->addChild('required', 'yes');
$question5->addChild('text', 'What programming stack are you familiar with?');
$programming_stack_options = $question5->addChild('options');
$programming_stack_options->addChild('option', 'REACT');
$programming_stack_options->addChild('option', 'ANGULAR');
$programming_stack_options->addChild('option', 'VUE');
$programming_stack_options->addChild('option', 'SQL');
$programming_stack_options->addChild('option', 'POSTGRES');
$programming_stack_options->addChild('option', 'MYSQL');
$programming_stack_options->addChild('option', 'MSSQL');
$programming_stack_options->addChild('option', 'Java');
$programming_stack_options->addChild('option', 'PHP');
$programming_stack_options->addChild('option', 'GO');
$programming_stack_options->addChild('option', 'RUST');

// Add question 6
$question6 = $xml->addChild('question');
$question6->addChild('name', 'certificates');
$question6->addChild('type', 'file');
$question6->addChild('required', 'yes');
$question6->addChild('text', 'Upload any of your certificates?');
$file_properties = $question6->addChild('file_properties');
$file_properties->addChild('format', '.pdf');
$file_properties->addChild('max_file_size', '1');
$file_properties->addChild('max_file_size_unit', 'mb');
$file_properties->addChild('multiple', 'yes');

// Output the XML
echo $xml->asXML();
?>
