@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Frequently Asked Questions (FAQ)',
        'path' => ['Home', 'FAQ'],
    ])

    <section class="mt-4 w-full overflow-hidden rounded-lg text-sm text-white/80">
        <div class="w-full rounded-lg overflow-hidden bg-black">
            <div class="p-4 lg:p-6 overflow-x-scroll">
                <div class="bg-background rounded-lg p-4">
                    @include('components.faq-item', [
                        'label' => 'Are there any additional fees?',
                        'description' => 'There are no additional fees charged.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'When is the market open for trading investments?',
                        'description' =>
                            'The forex market is open 24 hours a day every day in several parts of the world, from 5 PM EST on Sunday until 4 PM EST on Friday. The flexibility of forex for investment trading 24 hours is partly due to different international time zones.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I manage my risks?',
                        'description' =>
                            'Limit orders and stop-loss orders are the most common risk management tools in Forex Investment Trading. Limit orders help to limit the minimum price you will accept or the maximum price you will pay. Stop-loss orders are used to set positions to be liquidated automatically at a certain price to limit possible losses if the market moves against the investor\'s position.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What types of accounts do you offer?',
                        'description' =>
                            'We have various account types. You can explore the account types here and choose the one that suits you.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Is there a minimum trading volume for investments?',
                        'description' => 'You can trade with only a few dollars using our micro accounts.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What is a spread?',
                        'description' =>
                            'The spread is the difference between the bid and ask price of the base currency.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I open a trading investment account?',
                        'description' =>
                            'You can open two types of accounts - demo and live accounts. In the demo account, you will get virtual money to trade and learn virtually. In the live account, you first need to deposit funds to trade.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I log in to the trading investment platform?',
                        'description' =>
                            'After registering, you will get a username and password that you can use to log in to your account.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Are documents required to open an account with Daxtradefx?',
                        'description' =>
                            'To open an account, the following documents will be required: <br/> - Proof of identity such as passport or driver\'s license. <br/> - Proof of residence',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How many accounts can I open?',
                        'description' =>
                            'Daxtradefx offers three base currencies in which you can trade. You can have multiple accounts for each base currency.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What leverage is applied to my account?',
                        'description' => 'Your account can have a maximum leverage of 1:1000.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I verify my account?',
                        'description' => 'How do I verify my account?',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I open an account?',
                        'description' =>
                            'To open an account with Daxtradefx, you need to provide the required information and submit some identification documents.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I deposit funds into my account?',
                        'description' =>
                            'First, you need to pass our security and identification document process, then you can deposit funds into your account using various methods including bank transfer, bitcoin, and more.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'How do I withdraw money?',
                        'description' =>
                            'To do this, you need to complete our security and identification documents and select the amount you want to withdraw.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Do you offer Islamic accounts?',
                        'description' => 'Yes, we do offer them.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What spreads do you offer?',
                        'description' =>
                            'We offer variable spreads which may be as low as 0.0 pips. We do not have re-quoting: our clients are directly given the values accepted by our system.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What leverage do you offer?',
                        'description' =>
                            'The leverage offered for Daxtradefx trading accounts is up to 1:1000, depending on the account type.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Do you allow scalping?',
                        'description' => 'Yes, we allow scalping.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'What is stop loss?',
                        'description' =>
                            '- Stop-loss is an order to close a previously opened position at a price less favorable to the client compared to the value at the time of placing the stop loss. Stop loss can be a limit you set for your order. <br/> - Once this limit is reached, your order is closed. Please note that you must leave a certain distance from the current market value when you create stop/limit orders. For more details on distance in points for each currency pair, please see the limit and stop levels here.<br/> - Using stop loss is beneficial if you want to reduce your losses when the market moves against you. The stop-loss point is always set below the current loss on BUY, or above the current ASK price on SELL.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Do you allow hedging?',
                        'description' =>
                            '- Yes, we allow it. You are free to hedge your investment trading accounts. Hedging occurs when you open both long and short positions on the same instrument simultaneously. When you open BUY and SELL positions on the same instrument in the same lot size, the margin is 0. <br/> - However, when you open BUY and SELL positions on CFDs of the same type and lot size, margin is required only once, and can be seen here. CFD margin when you are hedged is usually 50%.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'Can I change my leverage? If yes, how?',
                        'description' =>
                            'Yes, under the My Account tab, you can change the leverage, then press the Change Leverage button in the Members section. That is the method for instant leverage change.',
                    ])
                    @include('components.faq-item', [
                        'label' => 'I still have questions.',
                        'description' =>
                            'For further questions, you can contact us via our email and contact numbers.',
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
