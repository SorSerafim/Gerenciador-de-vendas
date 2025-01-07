<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Venda;
use Authorization\IdentityInterface;

/**
 * Venda policy
 */
class VendaPolicy
{
    /**
     * Check if $user can add Venda
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Venda $venda
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Venda $venda)
    {
        return true;
    }

    /**
     * Check if $user can edit Venda
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Venda $venda
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Venda $venda)
    {
        return true;
    }

    /**
     * Check if $user can delete Venda
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Venda $venda
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Venda $venda)
    {
        return true;
    }

    /**
     * Check if $user can view Venda
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Venda $venda
     * @return bool
     */
    public function canView(IdentityInterface $user, Venda $venda)
    {
        return true;
    }
}
