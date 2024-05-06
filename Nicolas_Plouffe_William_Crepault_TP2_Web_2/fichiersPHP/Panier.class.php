<?php
require_once "Oeuvre.class.php";
class Panier
{
    protected $items = array();


    public function getItems()
    {
        return $this->items;
    }
    public function getCompteItems()
    {
        return count($this->items);
    }

    public function estVide()
    {
        return (empty($this->items));
    }

    public function ajouterItem(Oeuvre $p_idOeuvre, $p_Quantite)
    {

        if ($this->validerQte($p_Quantite) == true) {

            $idOeuvre = $p_idOeuvre->getIdOeuvre();
            if (!$idOeuvre) {
                throw new Exception("Le panier utilise l'ID du produit.");
            }
            if (isset($this->items[$idOeuvre])) {
                $this->miseAJourItem($p_idOeuvre, $p_Quantite);
            } else {
                $this->items[$idOeuvre] = array('item' => $p_idOeuvre, 'qte' => $p_Quantite);
            }
        }
    }

    public function miseAJourItem(Oeuvre $p_idOeuvre, $p_Quantite)
    {
        if ($this->validerQte($p_Quantite) == true) {

            $idOeuvre = $p_idOeuvre->getIdOeuvre();
            if ($p_Quantite === 0) {
                $this->supprimerItem($p_idOeuvre);
            } elseif ($p_Quantite > 0) {
                $this->items[$idOeuvre]['qte'] += $p_Quantite;
                // ajoute au panier à chaque clique je ne veux pas 
                // "écraser" la quantité, mais l'ajouter au panier.
            }
        }
    }  

    public function supprimerItem(Oeuvre $p_Item)
    {
        $idOeuvre = $p_Item->getIdOeuvre();
        if (isset($this->items[$idOeuvre])) {

            unset($this->items[$idOeuvre]);
        }
    }

    private function validerQte($p_Quantite)
    {
        if (filter_var(
            $p_Quantite,
            FILTER_VALIDATE_INT,
            ["options" => ["min_range" => 0, "max_range" => 10]]
        ) === false) {
            throw new Exception("La quantité est une valeur entre 0 et 10.");
        } else
            return true;
    }
}
