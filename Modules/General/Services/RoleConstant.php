<?php

namespace Modules\General\Services;

class RoleConstant
{

    /**
     * POS + CAJA ROLES
     */
    public const ROLE_POS_SUPERVISOR    = 'pos_supervisor';
    public const ROLE_POS_SELLER        = 'pos_seller';
    public const ROLE_POS_CASHIER       = 'pos_cashier';
    
    /**
     * SALE
     */
    public const ROLE_SL_MANAGER        = 'sl_manager';

    /**
     * List of roles that can change barcode auth code
     */
    public const AVAILABLE_BAR_AUTH_CODE_ROLES = [
        self::ROLE_POS_SUPERVISOR
    ];

}
