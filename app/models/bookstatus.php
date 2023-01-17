<?php 
enum BookStatus {
    case TO_BE_RESERVED;
    case RESERVED;
    case LEND_OUT;

    public static function intToEnum(int $id) : ?BookStatus {
        if ($id >= 0 && $id < sizeof(BookStatus::cases())) {
            return BookStatus::cases()[$id];
        }
        return null;
    }

    public function toString(): string {
        return match($this){
            self::TO_BE_RESERVED => 'To be reserved, we\'re working hard to find it! <i class="fa-solid fa-magnifying-glass d-none d-sm-none d-md-inline"></i>',
            self::RESERVED => 'Reserved and ready to be picked up! <i class="fa-solid fa-book d-none d-sm-none d-md-inline"></i>',
            self::LEND_OUT  => 'Lend out, enjoy your book! <i class="fa-regular fa-face-smile d-none d-sm-none d-md-inline"></i>',
            default => ''
        };
    }
}
?>