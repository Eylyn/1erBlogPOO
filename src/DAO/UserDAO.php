<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

class UserDAO extends DAO 
{

    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setRole($row['name']);
        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, role.name FROM user INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row) {
            $userid = $row['id'];
            $users[$userid] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }
    
    public function register(Parameter $post)
    {
        $this->checkUser($post);
        $sql = 'INSERT INTO user (pseudo, password, createdAt, role_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('pseudo'), password_hash($post->get('password'), PASSWORD_BCRYPT), 2]);
    }

    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $isUnique = $result->fetchColumn();
        if ($isUnique) {
            return '<p> Ce pseudo existe déjà</p>';
        }
    }

    public function login(Parameter $post)
    {
        $sql = 'SELECT user.id, user.role_id, user.password, role.name FROM user INNER JOIN role ON role.id = user.role_id WHERE pseudo = ?';
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();
        $isPasswordValid = password_verify($post->get('password'), $result['password']);
        return[
            'result' => $result,
            'isPasswordValid' => $isPasswordValid
        ];
    }

    public function updatePassword(Parameter $post, $pseudo)
    {
        $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [password_hash($post->get('password'), PASSWORD_BCRYPT), $pseudo]);
    }

    public function deleteAccount($pseudo)
    {
        $sql = 'DELETE FROM user WHERE pseudo = ?';
        $this->createQuery($sql, [$pseudo]);
    }

    public function deleteUser($userid)
    {
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userid]);
    }
}