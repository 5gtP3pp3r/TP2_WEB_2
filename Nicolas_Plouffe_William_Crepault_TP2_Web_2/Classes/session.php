<?php

class Session
{

    #region Conststantes et variables de session
    const PASSWORD_REGEX = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    const USERNAME_REGEX = '/^[A-Za-z0-9]{3,16}$/';

    #endregion

    #region Attributs

    private $userName;
    private $password;
    #endregion

    #region Getters et Setters
    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        if (!preg_match(self::USERNAME_REGEX, $userName)) {
            throw new Exception('Nom d\'utilisateur invalide');
        }

        $this->userName = $userName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (!preg_match(self::PASSWORD_REGEX, $password)) {
            throw new Exception('Mot de passe invalide');
        }
        $this->password = $password;
    }

    public function getUserType()
    {
        return $_SESSION['userType'] ?? null;
    }

    public function setUserType($userType)
    {
        $_SESSION['userType'] = $userType;
    }

    #endregion

    public function __construct()
    {
        session_start();
    }

    #endregion

    #region Méthodes
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function destroy()
    {
        session_destroy();
    }

    #endregion
}
