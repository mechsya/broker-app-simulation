<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;

class SidebarController extends Controller
{
    public static function user()
    {
        return [
            [
                "icon" => '<i class="bi bi-house-door"></i>',
                "name" => "Dashboard",
                "route" => 'home'
            ],
            [
                "icon" => '<i class="bi bi-gear-fill"></i>',
                "name" => "Setting",
                "route" => 'setting',
                "sub" => [
                    [
                        "name" => "Profile",
                        "route" => 'setting.profile'
                    ],
                    [
                        "name" => "Image",
                        "route" => 'setting.image'
                    ],
                    [
                        "name" => "Account Bank",
                        "route" => 'setting.bank'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-shield-shaded"></i>',
                "name" => "Security",
                "route" => 'security.index'
            ],
            [
                "icon" => '<i class="bi bi-person-vcard-fill"></i>',
                "name" => "KNC",
                "route" => 'knc.index'
            ],
            [
                "icon" => '<i class="bi bi-check2-circle"></i>',
                "name" => "Investment",
                "route" => 'investment.index'
            ],
            [
                "icon" => '<i class="bi bi-graph-up"></i>',
                "name" => "Trade",
                "route" => 'trade',
                "sub" => [
                    [
                        "name" => "Trade",
                        "route" => 'trade.index'
                    ],
                    [
                        "name" => "History",
                        "route" => 'trade.history'
                    ],
                    [
                        "name" => "Benefit",
                        "route" => 'trade.profits'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-cash"></i>',
                "name" => "Fund",
                "route" => 'fund',
                "sub" => [
                    [
                        "name" => "Bonus",
                        "route" => 'fund.bonus'
                    ],
                    [
                        "name" => "Profit",
                        "route" => 'fund.profits'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-wallet-fill"></i>',
                "name" => "Wallet",
                "route" => 'wallet',
                "sub" => [
                    [
                        "name" => "Saldo",
                        "route" => 'wallet.balance'
                    ],
                    [
                        "name" => "Add Saldo",
                        "route" => 'wallet.add-balance'
                    ],
                    [
                        "name" => "Transfer",
                        "route" => 'wallet.transfer'
                    ],
                    [
                        "name" => "Withdraw",
                        "route" => 'wallet.withdraw'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-diagram-3-fill"></i>',
                "name" => "Network",
                "route" => 'network',
                "sub" => [
                    [
                        "name" => "Referrals",
                        "route" => 'network.referrals'
                    ],
                    [
                        "name" => "Generation",
                        "route" => 'network.generation'
                    ]
                ]
            ],
            [
                "icon" => '<i class="fa fa-pencil-square-o"></i>',
                "name" => "Register",
                "route" => 'register.index'
            ],
            [
                "icon" => '<i class="bi bi-question-circle-fill"></i>',
                "name" => "FAQ",
                "route" => 'faq'
            ],
            [
                "icon" => '<i class="fa fa-newspaper-o"></i>',
                "name" => "News Update",
                "route" => 'news'
            ],
            [
                "icon" => '<i class="fa fa-comments"></i>',
                "name" => "Testimonial",
                "route" => 'testimonial',
                "sub" => [
                    [
                        "name" => "Testimonial",
                        "route" => 'testimonial.index'
                    ],
                    [
                        "name" => "Add Testimonial",
                        "route" => 'testimonial.add'
                    ]
                ]
            ],
            [
                "icon" => '<i class="fa fa-download"></i>',
                "name" => "Download",
                "route" => 'download'
            ],
            [
                "icon" => '<i class="fa fa-power-off"></i>',
                "name" => "Logout",
                "route" => 'logout'
            ],
        ];
    }
    public static function admin()
    {
        return [
            [
                "icon" => '<i class="bi bi-house-door"></i>',
                "name" => "Dashboard",
                "route" => 'dashboard.home'
            ],
            [
                "icon" => '<i class="bi bi-people-fill"></i>',
                "name" => "Pengguna",
                "route" => 'dashboard.users',
                "sub" => [
                    [
                        "name" => "Daftar User",
                        "route" => 'dashboard.users'
                    ],
                    [
                        "name" => "Request Verification",
                        "route" => 'dashboard.users.request'
                    ]
                ]
            ],
            [
                "icon" => '<i class="fa fa-comments"></i>',
                "name" => "Testimonials",
                "route" => 'testimonial',
                "sub" => [
                    [
                        "name" => "Request Testimonials",
                        "route" => 'dashboard.testimonials.index'
                    ],
                ]
            ],
            [
                "icon" => '<i class="bi bi-bag-fill"></i>',
                "name" => "Investments",
                "route" => 'investment',
                "sub" => [
                    [
                        "name" => "Create Investment",
                        "route" => 'dashboard.investments.create'
                    ],
                    [
                        "name" => "Investment Requests",
                        "route" => 'dashboard.investments.requests'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-cash"></i>',
                "name" => "Balances",
                "route" => 'balance',
                "sub" => [
                    [
                        "name" => "Request Balance",
                        "route" => 'dashboard.balances.requests'
                    ],
                    [
                        'name' => 'Request Withdraw',
                        "route" => 'dashboard.balances.withdrawals'
                    ]
                ]
            ],
            [
                "icon" => '<i class="bi bi-person-workspace"></i>',
                "name" => "Bank Accounts",
                "route" => 'admin',
                "sub" => [
                    [
                        "name" => "Manage Bank Accounts",
                        "route" => 'dashboard.admin.bank-accounts'
                    ]
                ]
            ],
            [
                "icon" => '<i class="fa fa-download"></i>',
                "name" => "Download",
                "route" => 'download.index'
            ],
            [
                "icon" => '<i class="fa fa-newspaper-o"></i>',
                "name" => "News",
                "route" => 'news.index'
            ],
            [
                "icon" => '<i class="fa fa-power-off"></i>',
                "name" => "Log Out",
                "route" => 'logout'
            ],
        ];
    }
}
