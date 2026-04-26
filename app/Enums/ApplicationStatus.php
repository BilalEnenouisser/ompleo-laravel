<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case PENDING = 'pending';
    case REVIEWED = 'reviewed';
    case SHORTLISTED = 'shortlisted';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'En attente',
            self::REVIEWED => 'Examiné',
            self::SHORTLISTED => 'Présélectionné',
            self::ACCEPTED => 'Accepté',
            self::REJECTED => 'Refusé',
        };
    }

    public static function validationRule(): string
    {
        return 'in:' . implode(',', array_column(self::cases(), 'value'));
    }

    public static function fromLabel(string $label): ?self
    {
        // Handling both "En attente" and legacy "En cours" mapping to PENDING
        if ($label === 'En cours') {
            return self::PENDING;
        }

        foreach (self::cases() as $case) {
            if ($case->label() === $label) {
                return $case;
            }
        }
        return null;
    }
}
