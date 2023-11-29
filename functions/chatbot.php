<?php
    function bot($message){
        include("../db.php");
        include("dependencies/blacklist.php");
        include("dependencies/greetings.php");
        include("dependencies/jokes.php");

        $answer = "I don´t understand. Can you please refrase your question?";
        $message = strtolower($message);
        $createdOn = "2023-08-28";
        $strPattern = '/\b(calculate|calculation)\b/i';
        $mathPattern = '/\d+\s*[\+\-\*\/]\s*\d+/';
        $birthDate = new DateTime($createdOn);
        // Get the current date
        $currentDate = new DateTime();

        // Calculate the difference between the current date and the birthday
        $age = $birthDate->diff($currentDate)->y;
        $createdOn = date("d. m Y", strtotime($createdOn));

        if(str_contains($message,"moin")
        || str_contains($message,"mojn")
        || str_contains($message,"hi")
        || str_contains($message,"hej")
        || str_contains($message,"god dag")
        || str_contains($message,"hallo")
        || str_contains($message,"hello")
        || str_contains($message,"hey")
        || str_contains($message,"greetings")
        || str_contains($message,"good morning")
        || str_contains($message,"good evening")
        || str_contains($message,"good afternoon")
        || str_contains($message,"good day")
        || str_contains($message,"good night")
        || str_contains($message,"good day")
        ){
            $answer = $greetings[array_rand($greetings, 1)] . " ". $nextGreetingsQuestions[array_rand($nextGreetingsQuestions, 1)];
        } else if($message == "What is the meaning of life?"){
            $answer = 42;
        } else if($message == "What is your name?" || str_contains($message, "your name")){
            $answer = "Hi my name is ".$botname . ". How may I call you?";
        } else if($message == "How old are you?"){
            $answer = "I´m {$age} years old. I was born on {$createdOn} and I´m being currently developed by my Master!";
        } else if(str_contains($message, "your purpose")){
            $answer = "My purpose is to serve you with some basic information. My developer has worked som simply statements in
            for you to test. I will do my best to learn more infos for you.";
        } else if($message == "tell me a joke"){
            $answer = $jokes[array_rand($jokes, 1)];
        }

        if(preg_match('/convert (\d+) (fahrenheit|celcius|celsius) to (fahrenheit|celcius|celsius)/i', $message, $convert)){
            $value = intval($convert[1]);
            $fromUnit = strtolower($convert[2]);
            $toUnit = strtolower($convert[3]);
            if ($fromUnit === "fahrenheit" && $toUnit === "celsius" || $toUnit === "celcius" && $fromUnit === "fahrenheit") {
                $result = floatval(($value - 32) * 5/9);
                $answer = "$value Fahrenheit is emessageual to $result Celsius";
                $answer = "
                    To convert $value degrees Fahrenheit to Celsius, you can use the following formula:<br>
                    °C=(°F−32)× 9/5 <br>
                    Let us calculate that: <br>
                    °C=({$value}°F−32)× 9/5 =(−27°F)× 9/5={$result}°C <br><br>
                    So, $value degrees Fahrenheit is emessageual to $result degrees Celsius.
                ";
            } elseif ($fromUnit === "celsius" && $toUnit === "fahrenheit" || $toUnit === "fahrenheit" && $fromUnit === "celcius") {
                $result = floatval(($value * 9/5) + 32);
                /* $answer = "$value Celsius is emessageual to $result Fahrenheit"; */
                $answer = "
                    To convert $value degrees Celsius to Fahrenheit, you can use the following formula:<br>
                    °F=(°C×5/9)+32 <br>
                    Let us calculate that: <br>
                    °F=({$value}°C×9/5)+32 = ({($value * 9/5)}°F) + 32 = {$result}°F<br><br>
                    So, $value degrees Celsius is emessageual to $result degrees Fahrenheit.
                ";
            }
        }

        foreach($blacklistWords as $blackWord){
            if(str_contains(strtolower($message), $blackWord)){
                $answer = "You have entered a word that is on my blacklist!";
            }
        }
        
        if(stristr($message,"my name is") || stristr($message,"call me")){
            if(preg_match('/name is([^(]+)/', $message, $matches) || preg_match('/call me([^(]+)/', $message, $matches)){
                $username = $matches[1];
                $answer = $greetings[array_rand($greetings, 1)] . " " . $username . "! " . $nextGreetingsQuestions[array_rand($nextGreetingsQuestions, 1)];

            }
        }

        if(preg_match($strPattern, $message)){
            $pattern = '/([\d+*\/\-]+)/';
            
            if(preg_match($pattern, $message, $matches) || preg_match($mathPattern, str_replace("x", "*", $message), $matches)){
                $calculation = $matches[0];
                eval("\$result = $calculation;");
                $answer = "I have calulated ". $calculation ." and the anwser is ". $result;
            }
        }
        if (preg_match_all('/(calculate|what is the sqrt\()(\d+(\.\d+)?)(\)|\?)?/i', str_replace("x", "*", $message), $sqaure)) {
            foreach ($sqaure[2] as $match) {
                $number = floatval($match);
                $result = sqrt($number);
                $answer = "The square root of $number is: $result";
            }
        } else if(preg_match_all('/(calculate|calculate the|what\'s the|what is the) square root of (\d+(\.\d+)?)/i', str_replace("x", "*", $message), $sqaure)){
            for ($i = 0; $i < count($sqaure[0]); $i++) {
                $number = floatval($sqaure[2][$i]);
                $result = sqrt($number);
                
                $answer = "The square root of $number is: $result";
            }
        }



        if(preg_match_all($mathPattern, $message, $mathMatch)){
            foreach($mathMatch[0] as $match){
                $calculation = $match;
                eval("\$result = $calculation;");
            }
            
            $answer = "I have calulated ". $calculation ." and the anwser is ". $result;
        }

        return $answer;
    }