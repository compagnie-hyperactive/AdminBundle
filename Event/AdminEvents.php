<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/05/15
 * Time: 16:03
 */

namespace Lch\AdminBundle\Event;


final class AdminEvents {
    const GENERATE_ADMIN_MENU = "lch.admin.generate_menu";

    const RENDER_LIST_PREFIX = "lch.admin.render.list.";
    const RENDER_LIST_BEFORE_PREFIX = "lch.admin.render.list.before.";
    const RENDER_PRE_HEADER_PREFIX = "lch.admin.render.pre.header.";
    const RENDER_HEADER_PREFIX = "lch.admin.render.list.header.";
    const RENDER_ROW_PREFIX = "lch.admin.render.list.row.";
    const RENDER_ROW_STATE_PREFIX = "lch.admin.render.list.row.state.";
    const RENDER_CELL_PREFIX = "lch.admin.render.list.cell.";
    const RENDER_ACTIONS_PREFIX = "lch.admin.render.list.row.actions.";
    const RENDER_LIST_AFTER_PREFIX = "lch.admin.render.list.after.";
}