<?php
session_start();
unset( $_SESSION['staff_info'] );

header( "Location: ./" );
