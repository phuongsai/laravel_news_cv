<div class="md:w-1/3 sidebar">
    <div class="w-full md:w-auto card bg-white mb-6 text-grey-darkest min-h-0">
        <header
            class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-grey-lightest mb-2">
            <h2 class="text-2xl mb-0">Settings</h2>
        </header>
        <div class="card__content">
            <ol class="list-none pl-0 mb-4">
                <li role="presentation" class="active">
                    <a class="text-red hover:text-red-darker transition mb-2 inline-block" href="{{ route('settings') }}">Edit
                        Your Account</a>
                </li>
                <li role="presentation">
                    <a class="text-red hover:text-red-darker transition mb-2 inline-block" href="{{ route('logout') }}">Logout</a>
                </li>
            </ol>
        </div>
    </div>
</div>