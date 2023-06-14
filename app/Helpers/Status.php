<?php
if ( ! function_exists('Status'))
{
	function Status()
	{
        $result = [
            1 => 'Ativo',
            0 => 'Inativo'
        ];

        return $result;
    }
}
