<?php
    function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars(($data));
            return $data;
        }
        function card_validation($num_card){
            $num_card = preg_replace('/\D/', '', $num_card);

            // Verificar que el número tenga solo dígitos
            if (!ctype_digit($num_card)) {
                return false; // El número contiene caracteres no válidos
            }
            $sum = 0;
            $len = strlen($num_card);
            $par = $len % 2 === 0; // Determina si la longitud es par

            for ($i = 0; $i < $len; $i++) {
                $digito = (int)$num_card[$i];

                // Duplica cada segundo dígito desde la derecha
                if (($i % 2 === 0 && $par) || ($i % 2 !== 0 && !$par)) {
                    $digito *= 2;
                    if ($digito > 9) {
                        $digito -= 9; // Si el dígito es mayor a 9, resta 9
                    }
                }
                $sum += $digito;
            }

            // Es válido si la suma es divisible por 10
            return $sum % 10 === 0;
        }