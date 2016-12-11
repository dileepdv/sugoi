<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Games extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('game');
        if (!$this->session->has_userdata('auth')) {
            redirect('users/get_login');
        }
    }

    /**
     * USERS GAME PAGE
     */
    public function index()
    {
        $data['errors'] = $this->session->flashdata('errors');
        $data['success'] = $this->session->flashdata('success');
        $user = $this->session->userdata('auth');

        $scores = $this->game->getGameByUserId($user['user_id']);
        $scores = $this->formatScores($scores);

        $levels = ['1', '2', '3'];
        $data = ['levels' => $levels, 'scores' => $scores];

        $this->load->view('layouts/header');
        $this->load->view('game/index', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * GAME LEVEL
     * @param $level
     */
    public function level($level)
    {
        $blocks = [];
        $time = '';
        $shapes = ['square', 'rectangle', 'triangle'];
        switch ($level) {
            case 1:
                $time = '60';
                $blocks = $this->getRandomBlocks(5, $shapes);
                break;
            case 2 :
                $time = '45';
                $blocks = $this->getRandomBlocks(7, $shapes);
                break;
            case 3 :
                $time = '30';
                $blocks = $this->getRandomBlocks(10, $shapes);
                break;
            default :
                $time = '30';
                $blocks = $this->getRandomBlocks(10, $shapes);
                break;
        }
        $count_of_blocks = array_count_values($blocks);

        $data = ['blocks' => $blocks, 'time' => $time, 'count_of_blocks' => $count_of_blocks];
        $this->load->view('layouts/header');
        $this->load->view('game/play', $data);
        $this->load->view('layouts/footer');
    }

    /**
     * GENERATE RANDOM BLOCKS
     *
     * @param $int
     * @param $shapes
     * @return array
     */
    private function getRandomBlocks($int, $shapes)
    {
        $tmp = [];
        for ($i = 0; $i < $int; $i++) {
            shuffle($shapes);
            $tmp = array_merge($tmp, $shapes);
        }
        shuffle($tmp);

        return $tmp;
    }

    /**
     * SAVE GAME DETAILS AFTER FINISH
     */
    public function save()
    {
        $this->load->library('form_validation');
        //RULES
        $this->form_validation->set_rules('level', 'level', 'trim|required');
        $this->form_validation->set_rules('total', 'total', 'trim|required');
        $this->form_validation->set_rules('score', 'score', 'trim|required');

        if ($this->form_validation->run() == false) {
            $messages['errors'] = validation_errors();
            $this->index($messages);
            return;
        }
        //STORE
        $this->game->store();
        $this->session->set_flashdata('success', 'Game has been successfully saved.');
        redirect('games/');
    }

    /**
     * FORMAT SCORES BY LEVELS
     * @param $scores
     * @return array
     */
    private function formatScores($scores)
    {
        $formatted_scores = [];
        foreach ($scores as $score) {
            $formatted_scores[$score->level][] = $score;
        }

        return $formatted_scores;
    }
}