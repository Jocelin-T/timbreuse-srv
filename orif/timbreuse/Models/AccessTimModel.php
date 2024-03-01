<?php

namespace Timbreuse\Models;

use CodeIgniter\Model;

class AccessTimModel extends Model
{
    protected $table = 'access_tim_user';
    protected $primaryKey = 'id_access';
    protected $allowedFields = ['id_user', 'id_ci_user'];

    public function get_access_users($ciUserId)
    {
        return $this->select('id_user')
            ->where('id_ci_user', $ciUserId)->findall();
    }

    public function get_access_users_with_info($ciUserId)
    {
        return $this->select('access_tim_user.id_user, name, surname')
            ->join('user_sync', 'user_sync.id_user = access_tim_user.id_user')
            ->where('id_ci_user =', $ciUserId)
            ->findall();
    }

    public function is_access(int $ciIdUser, int $timUserId): bool
    {
        $access = $this->select('id_user')
            ->where('id_ci_user', $ciIdUser)
            ->where('id_user', $timUserId)
            ->findall();
        return !empty($access);
    }

    public function have_one_access($ciIdUser): bool
    {
        $access = $this->select('id_user')->where('id_ci_user', $ciIdUser)
            ->findall();
        return count($access) === 1;

    }

    public function get_tim_user_id($ciUserId): ?int
    {
        return $this->select('id_user')
            ->where('id_ci_user', $ciUserId)->first()['id_user'] ?? null;
    }
    
    /**
     * Insert new access_tim_user
     *
     * @param  int $timUserId
     * @param  int $ciUserId
     * @return int|bool
     */
    public function add_access(int $timUserId, int $ciUserId): int|bool {
        return $this->insert([
            'id_user' => $timUserId,
            'id_ci_user' => $ciUserId
        ]);
    }
}
