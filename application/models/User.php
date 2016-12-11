<?php

class User extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        $user = $this->uniqueEMailId($this->input->post('email'));

        if (!is_null($user)) {
            return false;
        }
        $new_user['email'] = $this->input->post('email');
        $new_user['phone'] = $this->input->post('phone');
        $new_user['password'] = md5($this->input->post('password'));
        $this->db->insert('users', $new_user);
        $user_id = $this->db->insert_id();
        return $this->get($user_id);
    }

    private function uniqueEMailId($email)
    {
        $user = $this->db->where('email', $email)->get('users', 1);
        return $user->row();
    }

    public function validate()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $query = $this->db->where('email', $email)
            ->where('password', md5($password))
            ->get('users');

        if (!is_null($query)) {
            return $query->row();
        }

        return false;
    }

    private function get($user_id)
    {
        $user = $this->db->where('id', $user_id)
            ->get('users');
        return $user->row();
    }
}