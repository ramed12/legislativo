<?php
if ( ! function_exists('SetStatus'))
{
	function SetStatus($id)
	{
        switch ($id) {
            case 0:
                $status = "Inativo";
                break;
            case 1:
                $status = "Ativo";
                break;
        }

        return $status;
    }
}
