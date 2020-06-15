<div class="container py-16 px-5">
    <div class="gutter md:flex flex-col md:flex-row items-start">
        <!-- Welcome user -->
        <div class="md:w-2/3">
            <div class="card text-grey-darkest">
                <div
                    class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-grey-lightest mb-2">
                    <h3 class="text-2xl mb-0">Hi, Phuong Hoang</h3>
                </div>
                <div class="card__content">
                    <p>Welcome to your account dashboard</p>
                </div>
            </div>
        </div>
        <!-- /Welcome user -->

        <!-- Change information -->
        <div class="card md:w-2/3 text-grey-darkest">
            <div class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-grey-lightest">
                <h3 class="text-2xl mb-0 leading-tight">Edit your account</h3>
            </div>

            <!-- Form info -->
            <div class="card__content">
                <form method="post" action="/account/update" class="gutter">
                    <input type="hidden" name="_token" value="i3rK1GConJ8bk8PNs7usj2h1xxrSITXUPqZGKvDX">
                    <div class="md-col-7 mb-6">
                        <label for="name">* Your Display Name</label>
                        <div class="col-sm-10">
                            <input id="name" type="text" class="input w-full" name="name" value="Phuong Hoang">
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="email">* E-Mail Address</label>
                        <div class="col-sm-10">
                            <input id="email" type="email" class="input w-full" name="email"
                                value="nhoclyit+laravel-news.com@gmail.com">
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="email">Short Bio</label>
                        <div class="col-sm-10">
                            <textarea name="bio" id="bio" cols="30" rows="10" class="input w-full"></textarea>
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="twitter">Your Twitter</label>
                        <div class="col-sm-10">
                            <input id="twitter" type="text" class="input w-full" name="twitter" value=""
                                placeholder="@laravelnews">
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="facebook">Your Facebook Username</label>
                        <div class="col-sm-10">
                            <input id="facebook" type="text" class="input w-full" name="facebook" value="">
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="github">Your Github Username</label>
                        <div class="col-sm-10">
                            <input id="github" type="text" class="input w-full" name="github" value="">
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" class="input w-full" name="password">
                            <span id="helpBlock" class="label text-xs text-grey-darker mt-1"><strong>Leave blank
                                    to keep your current password</strong></span>
                        </div>
                    </div>
                    <div class="md-col-7 mb-6">
                        <label for="password_confirmation" class="col-sm-2 control-label">Confirm
                            Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="password_confirmation" class="input w-full"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="btn">Update</button>
                    </div>
                </form>
            </div>
            <!-- /Form info -->
        </div>
        <!-- /Change information -->

        <!-- Sidebar user info -->
        @include('sidebar_user')
        <!-- /Sidebar user info -->
    </div>
</div>