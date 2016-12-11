<?php

class Game extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * STORE NEW GAME
     * @return mixed
     */
    public function store()
    {
        $user = $this->session->userdata('auth');
        $new_game['user_id'] = $user['user_id'];
        $new_game['level'] = $this->input->post('level');
        $new_game['total'] = $this->input->post('total');
        $new_game['score'] = $this->input->post('score');

        return $this->db->insert('games', $new_game);
    }

    /**
     * GET ALL GAMES PLAYED BY USER
     * @param $user_id
     * @return mixed
     */
    public function getGameByUserId($user_id)
    {
        $query = $this->db->where('user_id', $user_id)->get('games');
        return $query->result();
    }
}