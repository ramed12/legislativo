<?php


if ( ! function_exists('Notificacao'))
{
	function Notificacao()
	{
        $notificacao = \DB::table('notificacao')
        ->whereNotNull("status");

        return $notificacao;

	}
}

