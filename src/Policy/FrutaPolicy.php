<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Fruta;
use Authorization\IdentityInterface;

/**
 * Fruta policy
 */
class FrutaPolicy
{
    /**
     * Check if $user can add Fruta
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Fruta $fruta
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Fruta $fruta)
    {
        return true;
    }

    /**
     * Check if $user can edit Fruta
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Fruta $fruta
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Fruta $fruta)
    {
        return true;
    }

    /**
     * Check if $user can delete Fruta
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Fruta $fruta
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Fruta $fruta)
    {
        return true;
    }

    /**
     * Check if $user can view Fruta
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Fruta $fruta
     * @return bool
     */
    public function canView(IdentityInterface $user, Fruta $fruta)
    {
        return true;
    }
}
